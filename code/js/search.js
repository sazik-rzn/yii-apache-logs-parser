/* 
 *  File "search" created 27.04.2020 21:33:30 in UTF-8 by Sazonov V.
 *  Contacts: 
 *  * Email: sazik.rzn@gmail.com
 *  * Telegram: @sazik_rzn
 *  * Skype: vladimir_s_sazonov
 *  * Git: https://github.com/sazik-rzn
 *  * Phone: +7(920)972-24-88
 * 
 * Copyright (c) 2020, Sazonov Vladimir
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Sazonov Vladimir nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

var Search = {
    url: undefined,
    query_api: undefined,
    conditions: {},
    reqData: {},
    init: function (query) {
        this.url = query;
        $('.filter-condition').on("change", function () {
            if ($('.filter-condition').val() == 'range') {
                $('.filter-range').show();
            } else {
                $('.filter-range').hide();
            }
        });
        $('.search-submit').click(function () {
            Search.submit();
        });
        $('.filter-add').click(function () {
            Search.filter();
        });
        $('.group-add').click(function () {
            Search.group();
        });
        $('.order-add').click(function () {
            Search.order();
        });
        $('#searchSettings a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        this.show();
    },
    filter: function () {
        var val = $('.filter-value').val();
        var cond = $('.filter-condition').val();
        var condition = cond + val;
        if (cond == 'range') {
            var val2 = $('.filter-value-range').val();
            condition = '>=' + val + '{AND}<=' + val2;
        }
        this.add('Log[' + $('.filter-field').val() + ']', $(".filter-field option:selected").text(), condition);
    },
    order: function () {
        this.add('Log_sort', 'sort by ' + $(".search-sort option:selected").text() + ' ' + $('.search-sort-type').val(), $('.search-sort').val() + '.' + $('.search-sort-type').val());
    },
    group: function () {
        this.add('group_by', 'group by ' + $(".search-group option:selected").text(), $('.search-group').val());
    },
    build: function () {
        this.reqData.json = true;
        if (this.url.indexOf('?') < 0) {
            this.query_api = this.url + '?';
        } else {
            this.query_api = this.url + '&';
        }
        $.each(this.reqData, (index, item) => {
            if (index != 'list')
                this.query_api += '&' + index + '=' + item;
        });
        delete this.reqData.json;
        this.reqData.list = true;

    },
    add: function (key, name, condition) {
        this.conditions[key] = {name: name, condition: condition};
        this.reqData[key] = condition;
        this.show();
    },
    rm: function (condition) {
        delete this.conditions[condition];
        delete this.reqData[condition];
        this.show();
    },
    show: function () {
        $('.search-conditions').empty();
        this.build();
        $.each(this.conditions, function (index, item) {
            if (index != 'partial') {
                if (index == 'Log_sort' || index == 'group_by') {
                    $('.search-conditions').append("<span style='margin: 3px;' class=\"label label-warning\"><b>" + item.name + "</b> <i style='cursor:pointer;' class=\"icon-remove\" onclick=\"Search.rm('" + index + "')\"></i> </span>");
                } else {
                    $('.search-conditions').append("<span style='margin: 3px;' class=\"label label-warning\"><b>" + item.name + "</b> <b>" + item.condition + "</b> <i style='cursor:pointer;' class=\"icon-remove\" onclick=\"Search.rm('" + index + "')\"></i> </span>");
                }
            }
        });
        $('.search-conditions').append("<br>API query: <a href=\"" + this.query_api + "\" target=\"_blank\">" + this.query_api + "</a>")
    },
    submit: function () {
        $.ajax({
            url: this.url,
            data: this.reqData,
            success: (data) => {
                $('.search-container').empty();
                $('.search-container').append(data);
            },
            async: true
        });
    },
    groupPage: function (container, group, page) {
        this.reqData['group_' + group + '_page'] = page;
        this.reqData.group_id = group;
        $.ajax({
            url: this.url,
            data: this.reqData,
            success: (data) => {
                delete this.reqData['group_' + group + '_page'];
                delete this.reqData.group_id;
                $('#' + container).empty();
                $('#' + container).append(data);

            },
            async: true
        });
    },
    deleteItem:function(id, url){
        $.ajax({
            url: url,
            data:[],
            success: (data) => {
                $('#' + id).remove();
            },
            async: true
        });
    }
}





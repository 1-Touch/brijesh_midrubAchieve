/*
 * Main javascript file
*/

jQuery(document).ready( function ($) {
    'use strict';
    
    /*
     * Get the website's url
     */
    var url =  $('meta[name=url]').attr('content');
    
    // Set current date
    var ctime = new Date();

    // Set current months
    var month = ctime.getMonth() + 1;

    // Set current day
    var day = ctime.getDate();

    // Set current year
    var year = ctime.getFullYear();
    
    // Default planification
    var planification = '<div class="panel panel-default">'
                            + '<div class="panel-heading">'
                                + '<div class="row">'
                                    + '<div class="col-xl-4">'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day" data-type="7">'
                                            + words.sun
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day" data-type="1">'
                                            + words.mon
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day" data-type="2">'
                                            + words.tue
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day" data-type="3">'
                                            + words.wed
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day" data-type="4">'
                                            + words.thu
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day" data-type="5">'
                                            + words.fri
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day" data-type="6">'
                                            + words.sat
                                        + '</button>'
                                    + '</div>'
                                    + '<div class="col-xl-2">'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-date-from open-midrub-planner">'
                                            + '<i class="fas fa-calendar-alt"></i>'
                                            + month + '-' + day + '-' + year
                                        + '</button>'
                                        + '<input type="hidden" class="planner-bulk-schedule-planifications-list-date-from-full" value="' + month + '-' + day + '-' + year + '">'
                                    + '</div>'
                                    + '<div class="col-xl-2">'
                                        + '<i class="fas fa-arrows-alt-h"></i>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-date-to open-midrub-planner">'
                                            + '<i class="fas fa-calendar-alt"></i>'
                                            + month + '-' + (day+1) + '-' + year
                                        + '</button>'
                                        + '<input type="hidden" class="planner-bulk-schedule-planifications-list-date-to-full" value="' + month + '-' + (day+1) + '-' + year + '">'
                                    + '</div>'
                                    + '<div class="col-xl-2">'
                                        + '<div class="planner-bulk-schedule-planifications-list-time">'
                                            + '<i class="icon-clock"></i>'
                                            + planification_time('from')
                                        + '</div>'
                                    + '</div>'
                                    + '<div class="col-xl-2">'
                                        + '<i class="fas fa-arrows-alt-h"></i>'
                                        + '<div class="planner-bulk-schedule-planifications-list-time">'
                                            + '<i class="icon-clock"></i>'
                                            + planification_time('to')
                                        + '</div>'                                  
                                    + '</div>'
                                + '</div>'
                            + '</div>'
                            + '<div class="panel-body">'
                                + '<hr>'
                                + '<div class="row">'
                                    + '<div class="col-xl-3">'
                                        + '<div class="dropdown">'
                                            + '<button class="btn btn-secondary planner-bulk-schedule-planifications-select-order dropdown-toggle" data-type="1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                + '<i class="fas fa-sort-alpha-down"></i>'
                                                + words.ordered
                                            + '</button>'
                                            + '<div class="dropdown-menu planner-bulk-schedule-planifications-select-order-list" aria-labelledby="dropdownMenu1">'
                                                + '<button class="dropdown-item" data-type="1" type="button">'
                                                    + '<i class="fas fa-sort-alpha-down"></i>'
                                                    + words.ordered
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="2" type="button">'
                                                    + '<i class="fas fa-sort-alpha-down"></i> '
                                                    + words.random
                                                + '</button>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<div class="col-xl-3">'
                                        + '<div class="dropdown">'
                                            + '<button class="btn btn-secondary planner-bulk-schedule-planifications-select-limit dropdown-toggle" data-type="1" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                + '<i class="far fa-share-square"></i>'
                                                + '1 ' + words.posts_daily
                                            + '</button>'
                                            + '<div class="dropdown-menu planner-bulk-schedule-planifications-select-limit-list" aria-labelledby="dropdownMenu2">'
                                                + '<button class="dropdown-item" data-type="1" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '1 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="2" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '2 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="3" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '3 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="4" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '4 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="5" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '5 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="6" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '6 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="7" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '7 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="8" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '8 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="9" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '9 ' + words.posts_daily
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="10" type="button">'
                                                    + '<i class="far fa-share-square"></i>'
                                                    + '10 ' + words.posts_daily
                                                + '</button>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<div class="col-xl-3">'
                                        + '<div class="dropdown">'
                                            + '<button class="btn btn-secondary planner-bulk-schedule-planifications-select-interval dropdown-toggle" data-type="1" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                + '<i class="fas fa-sort"></i>'
                                                + words.exact_interval
                                            + '</button>'
                                            + '<div class="dropdown-menu planner-bulk-schedule-planifications-select-interval-list" aria-labelledby="dropdownMenu3">'
                                                + '<button class="dropdown-item" data-type="1" type="button">'
                                                    + '<i class="fas fa-sort"></i>'
                                                    + words.exact_interval
                                                + '</button>'
                                                + '<button class="dropdown-item" data-type="2" type="button">'
                                                    + '<i class="fas fa-sort"></i>'
                                                    + words.random_interval
                                                + '</button>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                    + '<div class="col-xl-3">'
                                        + '<button type="button" class="btn btn-delete-planification" data-id="3334">'
                                            + '<i class="icon-trash"></i> ' + words.delet
                                        + '</button>'
                                    + '</div>'
                                + '</div>'
                            + '</div>'
                        + '</div>';
    
    /*******************************
    METHODS
    ********************************/
   
    /*
     * Load available networks
     * 
     * @since   0.0.7.5
     */
    Main.account_manager_load_networks = function () {
        
        var data = {
            action: 'account_manager_load_networks'
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'account_manager_load_networks');
        
    };
    
    /*
     * Display posts by page in the posts list
     * 
     * @param integer page contains the page number
     * 
     * @since   0.0.7.5
     */
    Main.planner_all_posts = function (page) {
        
        var data = {
            action: 'planner_display_all_posts',
            key: $( '.planner-search-for-posts' ).val(),
            limit: $('#dropdownDisplayedPosts').attr('data-limit'),
            page: page
        };

        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_display_all_posts');
        
    };
    
    /*
     * Display posts by page in the planify modal
     * 
     * @param integer page contains the page number
     * 
     * @since   0.0.7.5
     */
    Main.planner_planify_all_posts = function (page) {
        
        var data = {
            action: 'planner_planify_display_all_posts',
            page: page
        };
        
        if ( $('.main .planification_details_manage').length > 0 ) {
            data.planification_id = $('.main .planification_details_manage').attr('data-id');
        }
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_planify_display_all_posts');
        
    };
    
    /*
     * Display pagination in the planner
     * 
     * @param string id contains the id
     * @param integer total contains the total number of posts
     * @param integer limit contains the limit number
     * 
     * @since   0.0.7.5
     */
    Main.show_planner_pagination = function( id, total, limit ) {
        
        // Empty pagination
        $( id + ' .pagination' ).empty();
        
        // Verify if page is not 1
        if ( parseInt(Main.pagination.page) > 1 ) {
            
            var bac = parseInt(Main.pagination.page) - 1;
            var pages = '<li class="page-item"><a href="#" class="page-link" data-page="' + bac + '">' + Main.translation.theme_prev + '</a></li>';
            
        } else {
            
            var pages = '<li class="pagehide page-item"><a href="#" class="page-link">' + Main.translation.theme_prev + '</a></li>';
            
        }
        
        // Count pages
        var tot = parseInt(total) / limit;
        tot = Math.ceil(tot) + 1;
        
        // Calculate start page
        var from = (parseInt(Main.pagination.page) > 2) ? parseInt(Main.pagination.page) - 2 : 1;
        
        // List all pages
        for ( var p = from; p < parseInt(tot); p++ ) {
            
            // Verify if p is equal to current page
            if ( p === parseInt(Main.pagination.page) ) {
                
                // Display current page
                pages += '<li class="active page-item"><a data-page="' + p + '" class="page-link">' + p + '</a></li>';
                
            } else if ( (p < parseInt(Main.pagination.page) + 3) && (p > parseInt(Main.pagination.page) - 3) ) {
                
                // Display page number
                pages += '<li class="page-item page-item"><a href="#" class="page-link" data-page="' + p + '">' + p + '</a></li>';
                
            } else if ( (p < 6) && (Math.round(tot) > 5) && ((parseInt(Main.pagination.page) === 1) || (parseInt(Main.pagination.page) === 2)) ) {
                
                // Display page number
                pages += '<li class="page-item page-item"><a href="#" class="page-link" data-page="' + p + '">' + p + '</a></li>';
                
            } else {
                
                break;
                
            }
            
        }
        
        // Verify if current page is 1
        if (p === 1) {
            
            // Display current page
            pages += '<li class="active page-item"><a data-page="' + p + '" class="page-link">' + p + '</a></li>';
            
        }
        
        // Set the next page
        var next = parseInt( Main.pagination.page );
        next++;
        
        // Verify if next page should be displayed
        if (next < Math.round(tot)) {
            
            $( id + ' .pagination' ).html( pages + '<li class="page-item"><a href="#" class="page-link" data-page="' + next + '">' + Main.translation.theme_next + '</a></li>' );
            
        } else {
            
            $( id + ' .pagination' ).html( pages + '<li class="pagehide page-item"><a href="#" class="page-link">' + Main.translation.theme_next + '</a></li>' );
            
        }
        
    };
    
    /*
     * Upload a media file
     * 
     * @param object file contains the file
     * 
     * @since   0.0.7.5
     */
    Main.saveFile = function (file) {
        
        if ( file.size > ( parseInt($('.planner-page').attr('data-up')) * 1048576 ) ) {
            
            // Display alert
            Main.popup_fon('sube', words.file_too_large, 1500, 2000);
            
            return;
            
        }
       
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
        Main.object = {};

        var fileType = file.type.split('/');
        
        var form = new FormData();
        
        form.append('path', '/');
        
        form.append('file', file);
        
        form.append('type', fileType[0]);
        
        form.append('enctype', 'multipart/form-data');
        
        form.append($('.upim').attr('data-csrf'), $('input[name="' + $('.upim').attr('data-csrf') + '"]').val());
        
        Main.getPreview(file, Main.object);

        var s = 0;
        
        var intval = setInterval(function(){}, 1000);
        
        var timer = setInterval(function(){
            var cover = Main.object.cover;
            
            if ( typeof cover !== 'undefined') {
                Main.uploadFile( form, Main.object.cover );
                clearInterval(timer);
                clearInterval(intval);
            }
            
            if ( s > 15 ) {
                
                Main.cover = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAYAAAA8AXHiAAASFUlEQVR4Xu2df3Qb1ZXHv/dJtpw4QIBuCIE0kSXH+mFLdmJ+lZQeBwqFbdjC7oa0EAiw3f46LS20S84eGrJsOcuPLpRue/YHdJeybQMukARSfme9LW227bqx5ESSHUv2hkAaoCGQHziypLl7Rk6oI83YI8mTscZv/vLx3Hffe9/7OZqZO+/dIchDKmCCAmSCT+lSKgAJloTAFAUkWKbIKp1KsCQDpiggwTJFVulUgiUZMEUBCZYpskqnEizJgCkKSLBMkVU6lWBJBkxRwDBY0Wi03uVyCVNGIZ1WhQIulyvjdruPGBmscbASqe0Amo04lTY2VYDoibCvYaWR2UmwjKgkbUYVkGBJEkxRQIJliqzSqQRLMmCKAhIsU2SVTk8gWPtJ4FtScXspwEwzwFwc1xMGFvNr4YB3gb1klbPp6RmaLeqU/UVKSLAkHJUoIMGqRD3ZVlcBCZaEwxQFJFimyCqdSrAkA6YoIMEyRVbpVII1zRjo6mLn3LlvnJIWI1cQ8wVgnAJW3gKjKzMsfj44+LtDK1asyFUqiwSrUgWrqH1kR7JDOOjLCrCMgFMKhs4A3gboBUXJPtgWXBSpZGoSrErUq6K2kdjATSTEDwwO+SCBO0J+7+8M2heZSbDKVa5K2nV2djp8oSVfZ8Y6AHXGh81ZJUc3tDV7fmK8zR8tJVjlqFZFbSKx/qUgRxcROcsYtpLNZtqWtPh6S20rwSpVsSqy39b32jwHZ9R7pT8pf9jcFfZ7l5XaXoJVqmJVZB9JDN5G4G9XOmTO5pa3tizaXIofCVYpalWRbSwWq82Kuj4A7qJhE94C+LsOqn0pk8u8y8ACB7AShOsB1BTbUyRzyH1ueztljEogwTKqVJXZRRIDlxLEi1rDdhAvbfZ5f1V4LtI3eBcxf7Pw/wQcUERtoLVp/htGZZBgGVWqyuyiieT9AH29YNgMgbvCTR71CVHziPalXgHj4uNOEuWIlfNKST9IsKoMGKPDjcRTm4nwp2PtGXygRkmfFQwGD+n56UkkVwvQfxSezzHfsDjgfcxo/xIso0pVmV00kdoCoOBpjgdnOjnQ2NiY1pvOth2DYYeDNbLu/I2w32v4QUCCVWXAGB1uNJHcAtBxYDFjoIaPNAeDwRE9P5FEahEB/cXnJVhGtbe1XSSRepqAqwouhX+gkcMLw+HwYd17rMTgcoCfKTzPzCtbA94njIomf7GMKlVldpF48i4iKnzCU180/2XY73lqnJv3R8C4+fibd+SI0Rbye9TaG4YOCZYhmarPqKc/dY5Q8Bu1WsJxo2fsJ4f4SKjJrea4jjui/amLwXgqv5Rm7EF41+kS/qDbvdeoEhIso0pVmR0zU7RvsIeAcNHQmV9j5itag42xY+e2xQaudAjxIwAnFdtTZEOne8m6daQYlUGCZVSpKrSL9KVuJMa/aw2dgWFibAXhbQY8BLQX/bqNNhwhiEtDfvfPS5FAglWKWlVmu3X37hkzD42kCDiz3KEzlM2t/sblpbaXYJWqWJXZ7+gfDOcU/i8Ap5Ux9DdYUS4be8k06kOCZVSpKrbrjacuAWEzA65SppFVshctCTa9WkqbY7YSrHJUq8I2kXjyKhDdS4BX515q7Kx2ZLLKbe0tjS+VO1UJVrnKVWG7WGxobpayt4PE53WWKWeI6B7McDwYWrCguKBHCXOWYJUgll1Mu+PxM51cczER+SCoHox3AexQjogtbW1u9e+KDwmWhoS9iVQLiHwhX8NPK1ZYx4Fampxr6te2Bry3m9WHlX4lWAXq9yZ2LWHKbgGjjhhXhwKe5yY7QOrqzgxcz5OgDoAfeGfv7jUdHR3Zye7HSn8SrDHqR5PJOZyh3xJwtBAc7xNZ50dbWhYmJitI6k7kU89IbSSiywGoH1PIEuiLIX/Dw5PVx1TwI8E6GoVfDwycPCNLzwD0sbGBYWCXcDiXhRYtGKw0YMzs2B4fXMsCawt8KYLo0y2+hs5K+5gq7SVYAIaGhureO6K8IoguYObCT7KwClcaI+3n+f37Kglcbzz5N0yk1uUs2rBAhAOZXPaT5eaNKhmXGW2nPVgqVAeGlXtA+Mq4+R3CkzMds29ubDz9QOmBYIpsH7yKHPxDEM0ap/3rIMdFYd/CodL7mFotpj1YvX2DdzDznQAm2imsMOPR1oDn+LVKBuIZi+0KZEV2K4oLcRS2ZoCHUIMLwl7vWwZcT1mTaQuWuqykd2DX1cjl1KUihmoaMJAD6Pb9e3c9ZPQprrd3yMfO3Esgmm+UAgI2IHP45lAoVFGS0mh/ZthNW7B29KfOySp4WaOcz7g65+FivtbIMt3RXNWsXxKhtcTgMUP5Sau/8boS200Z82kJVm8iuUQBbdGDihm7xOg6JXWNksbBaZDjU2Gf+wW9SKpLVuoPpp8HHf+U+YE98yEQdQH4pNa9HQFKjnltq99zLxFVXY5r2oEVTe6dw5nDvzr6MraICwbvSY84lzrqag/WKMPqcpMWHXjeFFlHh1aOq7u7u6Zm5uzHQfSpo7mqIheKolz3oZPrnt53cORuInxVf5Edfy7k9z46ZX6KDA5kWoEVi701K0MHnyfCUh199iuMVW0Bz8/U893xgcU1JDYBOFvnl2tPNoePLWn2Jo+dHydXdcwkDabvbuh0r1GX+nYNDdWdNpx7FkTq7uOibz+ql15m/ou2gHejwZhOCbNpA1Z3956ZzlnDLxLjI3q/IqzQqtZgg3oz/8FxdFOC+sullSZgEPrraMZHm5rm/UFtFIml1hDx34GoVvsqin/Z0PmfX1q3bt0H68d7enpmC9dJz4HoAh2A9zlydHlzs+d/pwQ1BgYxLcB6bmDAdVZO3APOX3K0jjQz390a8HwLIHWL1HFHJD50DVHuYYCKNxqMWj7losyN6VzNuUzYRIR6nX7Wh3wNq4ioqHhsTzzVSODNRLRIp+0bOaYLFwcadhmIq+Um0wKsiXJVDPp+2Of+CpH+LpRIInUrAf+oEzEF4E7ksIkd9CMCHIV2zPxq9n1a3t7ueU8v6uqqCgbU7e1aH2RX3wCkHC5a2tLQ8Kbl5EwwAFuDtY5ZXNU3eA2Q36mil6tav+GJhuuMbG3qiSfvE0Tf0NSU8jmuOxWFzxKEzx0PB/ecNst14fz584cnAiIa678Ywqku1zlV+1LKm5S0Y/VkrZuaaDzlnrc1WD19yQsF6GdFGzD/qFZ3Rsy4vP3o/dFEIubzUrWzHiPgah3bLEF8SeHcUiJapdowkBQO52WlvMTuTSQ/y6B/1XlSZAIeDfk9N000XivP2xasaDzZzES/1MtVESGVRc1Fi30f3lNqAKKJ5FZA90Y7DdCNAG4F8GElx1e3NRcXOZuoz0hiYC1BqHWsip4UASgK47Z332z4XkfH1Mxx2RKs7dsHz8g5lS0ECuoE8PVMRny8PVS8zXyigKvnI/39Z5HiVBcAhrTsCfi9Q9Rck85kDyxuboga8Vlos3Xr1hkzZ895gIjUy2oxXMwZZr6pNdh43FNsOX2Z0cZ2YHV3p06pqacXAD5fR7D3FMZn2ipcGZrfr5fjF0CYq90P78uxWFLJU5wKV/3sM54B5Svsaf1yZUDiyvHeAJgBjRGftgIrGt1bj9rDaiJRrQul9WQFRcF1bUHPj42IM5FNPsfFeAmM2Rq26kqFyExn/WWNjWe+PZEvvfOJxOunp/mIuuJUO6nL2Otk58XB4IJ4uX2Y0c42YOWrBFPdfSDcoiNUmhXc2xr0qEtkJu2IxodWArmH9dZZqSsVeKR+VTg8V7cm1USD2bEj6c058CJAagVkrV+u/0tn+aJzW7y7J/J1os7bBqxIIrUWzN/U+wIDg/+p1e+5RSsBWqnYkXjqa0R4QMdPPscV8nmuHS9PNtEY1ByXAvyGgBlav44M9FINXzpV1nFVPVjqUuLevkG1cp16edPcQs7MGzd2ev7cSK5qogDrne9JJO8XIPVJUOsSrIDEbZlD+77f3t5uuFZ6YV/qVnkGfgrSvPSq5k9i5NDq8Sr2lTu/UttVPVi9O3ddwrncRoB1XqPQrzOibrnRXFWpAh6zzz/FnTr3YQJfq+MjC6YvhAMNj5Tbh9ouGk9eD8pXNdYEmBV+pDXoVZ8kLT2qGqxtsYGAEGKr7mI9Rirzfvb89vam/AviE3FEE4NbAdZ7mZx2kvOKoG+h+lK77CMST95BRHfprYaAgr8OBxp+qPVOsuxOS2xYtWCp66qQOfyyXi4JoD2Emk+E/PMN180sUTtN823xwQWCeJNmJb3RTPzv66iuw+c7S6MysbER5OteHUh/hwR9VudmPgvBq8JN3seNeZx8q6oEK7+TmOp+QYTztCXhQ0SO60I+t7qW6oQfatb/6OrQD2l1zozDIuucHwqVX3iDmZ29icHnx8lxpRUon2jzN/73CRcAQFWC1dnJjqbm1K1QK6MU3mswZxWm1ZOVqyo3KJEd/eeS06nmuIo+kasw/2D2DMeX3W73kXL95++3ksk5GCH1Zv4iTT+E3Y4sL2sesxCxkv5KaVuVYB2bYCSeupcI6vdijt7I8ggz7msNeIs+NFSKKJNlO/r5EPG9MQ8WatL02bDf+2eT1Ufvzp0NSk68SiC1HKTWq5/dOVF7fjnvRCsZY1WDlV8VWj98HwFfzIvKeCgcaPiaGbmqckWO9g19Faw8mG9PtOkIp2+udEd14Vi2be9rF07nKwQq/HVUTdV1XP/jgutKv//sinZyl6JBVYOlTnQUrvc3g+m9jZ0NpuaqShF2rG0klvw2CbosN6wsW7y4sezXO+P13xPf+XEi8SSBTtaxe/ydva/d2NHRUdHl16gGVQ+WOlF1kwSQrg0G579jdOIn0q6rq6vupHnzZrU3mZv2iCaSN2D0y13Fl0SiHLPyzxt9nlvWjbNSdrJ0sQVYkyWGHfyMl+NSSyaB6POhJvejZue4JFh2oGnMHEZ3X898iEioK0y1XliPqHsa24KNplUrVIcjwbIZWMemE40nXx5nr+IwsbI0HGjcZtb0JVhmKWuxX7WAbQ3Vri8sJDdmWAMZBZe0Bz2vmTFUCZYZqk4Rnz09iYXCVdMNIvWrFBqXRd4jsmJxS8vkbyeTYE0RCMwaxmgBFLxAIK3XS+rm3C2Uca6o5PWS1tglWGZFdAr5zee44Nigv0Ob14d8nusns6qNBGsKAWDmUHpiydVCkLpxV+tJUU1DfCfU5F4zWWkICZaZ0ZxivqOxgb+FEH+vs0gwqyjK6taAd30lS6iPTVmCNcWCb+ZwRvcqnnE/0dF3q8WdqcVRbjBSrXCicUqwJlLIhucjsYFnSAjNSoIAHVaU7NK24CK1OEnZhwSrbOmqt+G2vr55DnY+qV8mAH1ORXQEg8Y/Ll6ohgSrevmoaOS9vTsbFKejlwgzdW7o33Yqtb5yX+xLsCoKT3U3jsYHFoOEWhZTp0wAPes8fdZngnPmHCp1phKsUhWzmX1+ryJhs96eTBL0b0+vf+wLY0tbGpFAgmVEJZvbjC6h1stxcUZh3NEW8N5XigwSrFLUsrFtJDawhoS4uyjHRXg3m+VzxlaGNiKDBMuIStPARl3lOvuMsx8Qo9+LHs3OE4YJ4tPlbKOTYE0DaEqZYk9sYJMQYnl+Ewbhr1p9HnWpc8mHBKtkyezd4Lex2FyXcP1YAf9iQBn5hxXB4Eg5M5ZglaOazdt0dXU5jX7dTE8KCZbNIbFqehIsq5S3eb8SLJsH2KrpSbCsUt7m/UqwbB5gq6YnwbJKeZv3K8GyeYCtmp4Eyyrlbd6vBMvmAbZqehIsq5S3eb8SLJsH2KrpSbCsUt7m/UqwbB5gq6YnwbJKeZv3K8GyeYCtmp4Eyyrlbd6vBMvmAbZqehIsq5S3eb8SLJsH2KrpSbCsUt7m/UqwbB5gq6YnwbJKeZv3K8GyeYCtmp4Eyyrlbd6vBMvmAbZqehIsq5S3eb8SLJsH2KrpWQ8W6B2GcqdVAsh+zVGAGDNAVFysjeiJsK9hpZFetb50oNkumkhtB9BsxKm0sakCEiybBtbqaUmwrI6ATfuXYNk0sFZPS4JldQRs2r8Ey6aBtXpapoAVjda7XC5h9dxk/9Yp4HK5Mm63+4iRERhONxhxJm2kAscUkGBJFkxRQIJliqzSqQRLMmCKAhIsU2SVTiVYkgFTFJBgmSKrdCrBkgyYooAEyxRZpVMJlmTAFAUkWKbIKp3+P7IOdjz4/Z7NAAAAAElFTkSuQmCC';
                Main.uploadFile( form, Main.object.cover );
                clearInterval(timer);
                clearInterval(intval);
                
            } else {
                s++;
            }
            
        }, 1000);

    };
    
    /*
     * Upload a CSV file
     * 
     * @param object file contains the file
     * 
     * @since   0.0.7.5
     */
    Main.saveCsvFile = function (file) {
        
        if ( file.size > ( parseInt($('.planner-page').attr('data-up')) * 1048576 ) ) {
            
            // Display alert
            Main.popup_fon('sube', words.file_too_large, 1500, 2000);
            
            return;
            
        }
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');

        var fileType = file.type.split('/');
        
        var form = new FormData();
        
        form.append('path', '/');
        
        form.append('file', file);
        
        form.append('type', fileType[0]);
        
        form.append('enctype', 'multipart/form-data');
        
        form.append($('.upcsv').attr('data-csrf'), $('input[name="' + $('.upcsv').attr('data-csrf') + '"]').val());
        
        // Set the action
        form.append('action', 'upload_csv');

        // Upload media
        $.ajax({
            url: url + 'user/app-ajax/planner',
            type: 'POST',
            data: form,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (data) {
                
                // Verify if the success response exists
                if ( data.success ) {

                    // Display alert
                    Main.popup_fon('subi', data.message, 1500, 2000);

                    // Get posts by search
                    Main.planner_all_posts(1);

                } else {

                    // Display alert
                    Main.popup_fon('sube', data.message, 1500, 2000);

                }
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                
                console.log(jqXHR);
                
            },
            complete: function (jqXHR, textStatus, errorThrown) {
                
                // Hide loading animation
                $('.page-loading').fadeOut('slow');
        
            }
            
        });

    };
    
    /*
     * Get preview
     * 
     * @param object file contains the file
     * @param object object
     * 
     * @since   0.0.7.5
     */
    Main.getPreview = function (file, object) {
        
        var fileReader = new FileReader();
        
        if ( file.type.match('image') ) {
            
            fileReader.onload = function () {
                
                var img = document.createElement('img');
                img.src = fileReader.result;

                var image = new Image();

                image.onload = function () {
                    var canvas = document.createElement('canvas');
                    canvas.width = 250;
                    canvas.height = 250;

                    canvas.getContext('2d').drawImage(this, 0, 0, 250, 250);

                    object.cover = canvas.toDataURL('image/png');
                };
                image.src = img.src;

            };
            
            fileReader.readAsDataURL(file);
            
        } else {
            
            fileReader.onload = function () {
                
                var blob = new Blob([fileReader.result], {type: file.type});
                
                var url = URL.createObjectURL(blob);
                
                var video = document.createElement('video');
                
                var timeupdate = function () {
                    if (snapImage()) {
                        video.removeEventListener('timeupdate', timeupdate);
                        video.pause();
                    }
                };
                
                video.addEventListener('loadeddata', function () {
                    if (snapImage()) {
                        video.removeEventListener('timeupdate', timeupdate);
                    }
                });
                
                var snapImage = function () {
                    var canvas = document.createElement('canvas');
                    canvas.width = 250;
                    canvas.height = 250;
                    canvas.getContext('2d').drawImage(video, 0, 0, 250, 250);
                    var image = canvas.toDataURL();
                    var success = image.length > 10;
                    if (success) {
                        var img = document.createElement('img');
                        img.src = image;
                        URL.revokeObjectURL(url);
                        object.cover = img.src;
                    }
                    return success;
                };
                
                video.addEventListener('timeupdate', timeupdate);
                
                video.preload = 'metadata';
                
                video.src = url;
                
                video.muted = true;
                
                video.playsInline = true;
                
                video.play();
                
            };
            
            fileReader.readAsArrayBuffer(file);
            
        }
        
    };
    
    /*
     * Upload a file
     * 
     * @param integer page contains the page number
     * 
     * @since   0.0.7.5
     */    
    Main.uploadFile = function (form, path) {
        
        // Set the media's cover
        form.append('cover', path);
        
        // Set the action
        form.append('action', 'upload_media_in_storage');

        // Upload media
        $.ajax({
            url: url + 'user/ajax/media',
            type: 'POST',
            data: form,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (data) {

                if ( data.success ) {
                    
                    // Get user's medias
                    Main.planner_load_medias(1);
                    
                    // Get post's id
                    var post_id = $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-history-posts li.planner-bulk-schedule-history-posts-edit').attr('data-id');

                    if ( typeof post_id !== 'undefined' ) {

                        // Prepare data to send
                        var data = {
                            action: 'planner_planify_add_post_media',
                            post_id: post_id,
                            media_id: data.media_id
                        };
                        
                        // Make ajax call
                        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_planify_add_post_media');
                        
                    } else {
                        
                        // Display alert
                        Main.popup_fon('subi', data.message, 1500, 2000);
                        
                    }
                    
                } else {
                    
                    // Display alert
                    Main.popup_fon('sube', data.message, 1500, 2000);
                    
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                
                console.log(jqXHR);
                
            }
            
        });

    };
    
    /*
     * Display user's medias
     * 
     * @param integer page contains the page number
     * 
     * @since   0.0.7.5
     */
    Main.planner_load_medias = function (page) {
        
        // Set media page
        Main.media = {
            page: page
        };
        
        // Prepare data to send
        var data = {
            action: 'get_media',
            page: page
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/ajax/media', 'GET', data, 'get_media');

    };
    
    /*
     * Deletes a post by post_id
     * 
     * @param integer post_id contains the post_id number
     * 
     * @since   0.0.7.5
     */
    Main.delete_post_by_id = function (post_id) {
        
        // Prepare the data to send
        var data = {
            action: 'planner_delete_post_by_id',
            post_id: post_id
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_delete_post_by_id');

    };
    
    /*
     * Load network's accounts
     * 
     * @since   0.0.7.5
     * 
     * @param string type contains the tab name
     * 
     * @param string network contains the network's name
     */
    Main.account_manager_get_accounts = function (network, type) {
        
        var data = {
            action: 'account_manager_get_accounts',
            network: network,
            type: type
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'account_manager_get_accounts');
        
    };
    
    /*
     * Load available networks
     * 
     * @since   0.0.7.5
     */
    Main.account_manager_load_networks = function () {
        
        var data = {
            action: 'account_manager_load_networks'
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'account_manager_load_networks');
        
    };
    
    /*
     * Reload accounts
     * 
     * @since   0.0.7.5
     */
    Main.reload_accounts = function () {
        
        var network = $('#nav-accounts-manager').find('.network-selected a').attr('data-network');
        
        $('.manage-accounts-all-accounts').empty();
        
        Main.account_manager_get_accounts(network, 'accounts_manager');
        
        Main.reload_accounts_list();
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    };
    
    /*
     * Reload accounts in the select list
     * 
     * @since   0.0.7.5
     */
    Main.reload_accounts_list = function () {
        
        var data = {
            action: 'planner_search_accounts',
            key: $( '.planner-bulk-schedule-search-for-accounts' ).val()
        };
        
        // Set CSRF
        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_accounts_results_by_search');
        
    };
    
    /*
     * Display planifications
     * 
     * @param integer start contains start date
     * @param integer end contains the end date
     * 
     * @since   0.0.7.5
     */
    Main.scheduled_events = function (start,end) {
        
        var data = {
            action: 'planner_display_all_planifications',
            start: start,
            end: end
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_display_all_planifications');
        
    };
    
    /*
     * Reset selected accounts and groups
     * 
     * @since   0.0.7.5
     */
    Main.reset_scheduled = function () {
        
        if ( typeof Main.selected_post_group !== 'undefined' ) {

            delete Main.selected_post_group;

        }

        if ( typeof Main.selected_post_accounts !== 'undefined' ) {

            delete Main.selected_post_accounts;

        }
        
        if ( typeof Main.selected_accounts !== 'undefined' ) {
            
            Main.selected_accounts = 0;
            
        }
        
    };
    
    /*
     * Return planification time
     * 
     * @param string name contains the time field name
     * @param integer selected contains the selected time
     * 
     * @since   0.0.7.5
     */
    function planification_time( name, selected ) {

        // Set planification time
        if ( $( '.main .planner-page' ).attr('data-date-format') === '12' ) {

            var sel = '08';
            var sel_h = '00';
            var format = 'AM';

            if ( selected ) {
            
                var time = selected.split(':');
                
                if ( time[0] > 12 ) {
                    
                    var n_time = parseInt(time[0]) - 12;
                    
                    if ( n_time < 10 ) {
                        
                        sel = '0' + n_time;
                        
                    } else {
                        
                        sel = n_time;
                        
                    }
                    
                    format = 'PM';
                    
                } else {
                    
                    sel = time[0];
                    
                }
                
                sel_h = time[1];
                
            }
            
            sel = sel.toString();
            
            return '<select class="midrub-calendar-time-hour-' + name + '">'
                        + '<option value="01"' + ( (sel === '01')?' selected':'' ) + '>&nbsp;01&nbsp;</option>'
                        + '<option value="02"' + ( (sel === '02')?' selected':'' ) + '>&nbsp;02&nbsp;</option>'
                        + '<option value="03"' + ( (sel === '03')?' selected':'' ) + '>&nbsp;03&nbsp;</option>'
                        + '<option value="04"' + ( (sel === '04')?' selected':'' ) + '>&nbsp;04&nbsp;</option>'
                        + '<option value="05"' + ( (sel === '05')?' selected':'' ) + '>&nbsp;05&nbsp;</option>'
                        + '<option value="06"' + ( (sel === '06')?' selected':'' ) + '>&nbsp;06&nbsp;</option>'
                        + '<option value="07"' + ( (sel === '07')?' selected':'' ) + '>&nbsp;07&nbsp;</option>'
                        + '<option value="08"' + ( (sel === '08')?' selected':'' ) + '>&nbsp;08&nbsp;</option>'
                        + '<option value="09"' + ( (sel === '09')?' selected':'' ) + '>&nbsp;09&nbsp;</option>'
                        + '<option value="10"' + ( (sel === '10')?' selected':'' ) + '>&nbsp;10&nbsp;</option>'
                        + '<option value="11"' + ( (sel === '11')?' selected':'' ) + '>&nbsp;11&nbsp;</option>'
                        + '<option value="12"' + ( (sel === '12')?' selected':'' ) + '>&nbsp;12&nbsp;</option>'
                    + '</select>'
                    + '<span>'
                        + ':'
                    + '</span>'
                    + '<select class="midrub-calendar-time-minutes-' + name + '">'
                        + '<option value="00"' + ( (sel_h === '00')?' selected':'' ) + '>&nbsp;00&nbsp;</option>'
                        + '<option value="10"' + ( (sel_h === '10')?' selected':'' ) + '>&nbsp;10&nbsp;</option>'
                        + '<option value="20"' + ( (sel_h === '20')?' selected':'' ) + '>&nbsp;20&nbsp;</option>'
                        + '<option value="30"' + ( (sel_h === '30')?' selected':'' ) + '>&nbsp;30&nbsp;</option>'
                        + '<option value="40"' + ( (sel_h === '40')?' selected':'' ) + '>&nbsp;40&nbsp;</option>'
                        + '<option value="50"' + ( (sel_h === '50')?' selected':'' ) + '>&nbsp;50&nbsp;</option>'
                    + '</select>'
                    + '<select class="midrub-calendar-time-period-' + name + '">'
                        + '<option value="AM"' + ( (format === 'AM')?' selected':'' ) + '>&nbsp;AM&nbsp;</option>'
                        + '<option value="PM"' + ( (format === 'PM')?' selected':'' ) + '>&nbsp;PM&nbsp;</option>'
                    + '</select>';

        } else {
            
            var sel = '08';
            var sel_h = '00';

            if ( selected ) {
            
                var time = selected.split(':');
                
                if ( time[0] < 10 ) {
                    
                    sel = '0' + time[0];
                    
                } else {
                    
                    sel = time[0];
                    
                }
                
                sel_h = time[1];
            
            }
            
            sel = sel.toString();

            return '<select class="midrub-calendar-time-hour-' + name + '">'
                        + '<option value="01"' + ( (sel === '01')?' selected':'' ) + '>&nbsp;01&nbsp;</option>'
                        + '<option value="02"' + ( (sel === '02')?' selected':'' ) + '>&nbsp;02&nbsp;</option>'
                        + '<option value="03"' + ( (sel === '03')?' selected':'' ) + '>&nbsp;03&nbsp;</option>'
                        + '<option value="04"' + ( (sel === '04')?' selected':'' ) + '>&nbsp;04&nbsp;</option>'
                        + '<option value="05"' + ( (sel === '05')?' selected':'' ) + '>&nbsp;05&nbsp;</option>'
                        + '<option value="06"' + ( (sel === '06')?' selected':'' ) + '>&nbsp;06&nbsp;</option>'
                        + '<option value="07"' + ( (sel === '07')?' selected':'' ) + '>&nbsp;07&nbsp;</option>'
                        + '<option value="08"' + ( (sel === '08')?' selected':'' ) + '>&nbsp;08&nbsp;</option>'
                        + '<option value="09"' + ( (sel === '09')?' selected':'' ) + '>&nbsp;09&nbsp;</option>'
                        + '<option value="10"' + ( (sel === '10')?' selected':'' ) + '>&nbsp;10&nbsp;</option>'
                        + '<option value="11"' + ( (sel === '11')?' selected':'' ) + '>&nbsp;11&nbsp;</option>'
                        + '<option value="12"' + ( (sel === '12')?' selected':'' ) + '>&nbsp;12&nbsp;</option>'
                        + '<option value="13"' + ( (sel === '13')?' selected':'' ) + '>&nbsp;13&nbsp;</option>'
                        + '<option value="14"' + ( (sel === '14')?' selected':'' ) + '>&nbsp;14&nbsp;</option>'
                        + '<option value="15"' + ( (sel === '15')?' selected':'' ) + '>&nbsp;15&nbsp;</option>'
                        + '<option value="16"' + ( (sel === '16')?' selected':'' ) + '>&nbsp;16&nbsp;</option>'
                        + '<option value="17"' + ( (sel === '17')?' selected':'' ) + '>&nbsp;17&nbsp;</option>'
                        + '<option value="18"' + ( (sel === '18')?' selected':'' ) + '>&nbsp;18&nbsp;</option>'
                        + '<option value="19"' + ( (sel === '19')?' selected':'' ) + '>&nbsp;19&nbsp;</option>'
                        + '<option value="20"' + ( (sel === '20')?' selected':'' ) + '>&nbsp;20&nbsp;</option>'
                        + '<option value="21"' + ( (sel === '21')?' selected':'' ) + '>&nbsp;21&nbsp;</option>'
                        + '<option value="22"' + ( (sel === '22')?' selected':'' ) + '>&nbsp;22&nbsp;</option>'
                        + '<option value="23"' + ( (sel === '23')?' selected':'' ) + '>&nbsp;23&nbsp;</option>'
                        + '<option value="00"' + ( (sel === '00')?' selected':'' ) + '>&nbsp;00&nbsp;</option>'                            
                    + '</select>'
                    + '<span>'
                        + ':'
                    + '</span>'
                    + '<select class="midrub-calendar-time-minutes-' + name + '">'
                        + '<option value="00"' + ( (sel_h === '00')?' selected':'' ) + '>&nbsp;00&nbsp;</option>'
                        + '<option value="10"' + ( (sel_h === '10')?' selected':'' ) + '>&nbsp;10&nbsp;</option>'
                        + '<option value="20"' + ( (sel_h === '20')?' selected':'' ) + '>&nbsp;20&nbsp;</option>'
                        + '<option value="30"' + ( (sel_h === '30')?' selected':'' ) + '>&nbsp;30&nbsp;</option>'
                        + '<option value="40"' + ( (sel_h === '40')?' selected':'' ) + '>&nbsp;40&nbsp;</option>'
                        + '<option value="50"' + ( (sel_h === '50')?' selected':'' ) + '>&nbsp;50&nbsp;</option>'
                    + '</select>';

        }
        
    };
   
    /*******************************
    ACTIONS
    ********************************/
   
    /*
     * Search for posts in the insights tab
     * 
     * @since   0.0.7.5
     */
    $(document).on('keyup', '.planner-search-for-posts', function () {
        
        if ( $( this ).val() === '' ) {
            
            // Hide cancel search button
            $( '.planner-cancel-search-for-posts' ).fadeOut('slow');
            
        } else {
         
            // Display cancel search button
            $( '.planner-cancel-search-for-posts' ).fadeIn('slow');
            
        }
        
        // Get posts by search
        Main.planner_all_posts(1);
        
    });
    
    /*
     * Search for accounts in the accounts manager popup
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'keyup', 'main .accounts-manager-search-for-accounts', function (e) {
        e.preventDefault();
        
        // Verify if search is in the accounts tab
        if ( $(this).closest('.tab-pane').attr('id') === 'nav-accounts-manager' ) {
            
            // Get network
            var network = $('#nav-accounts-manager').find('.network-selected a').attr('data-network');
            
            // Get search keys
            var key = $('#nav-accounts-manager').find('.accounts-manager-search-for-accounts').val();
            
            // Display cancel search icon
            $(this).closest( '.row' ).find( '.cancel-accounts-manager-search' ).fadeIn( 'slow' );
            
            var data = {
                action: 'account_manager_search_for_accounts',
                network: network,
                key: key,
                type: 'accounts_manager'
            };
            
            // Set CSRF
            data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'account_manager_search_for_accounts');
            
        } else if ( $(this).closest('.tab-pane').attr('id') === 'nav-groups-manager' ) {
            
            // Get network
            var network = $('#nav-groups-manager').find('.network-selected a').attr('data-network');
            
            // Get search keys
            var key = $('#nav-groups-manager').find('.accounts-manager-search-for-accounts').val();
            
            // Display cancel search icon
            $(this).closest( '.row' ).find( '.cancel-accounts-manager-search' ).fadeIn( 'slow' );

            var data = {
                action: 'account_manager_search_for_accounts',
                network: network,
                key: key,
                type: 'groups_manager'
            };
            
            // Set CSRF
            data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'account_manager_search_for_accounts');
            
        }
        
    });
    
    /*
     * Search for accounts
     * 
     * @since   0.0.7.5
     */
    $(document).on('keyup', '.planner-bulk-schedule-search-for-accounts', function () {
        
        if ( $( this ).val() === '' ) {
            
            // Hide cancel search button
            $( '.planner-bulk-schedule-cancel-search-for-accounts' ).fadeOut('slow');
            
        } else {
         
            // Display cancel search button
            $( '.planner-bulk-schedule-cancel-search-for-accounts' ).fadeIn('slow');
            
        }
        
        var data = {
            action: 'planner_search_accounts',
            key: $( this ).val()
        };
        
        // Set CSRF
        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_accounts_results_by_search');
        
    });
    
    /*
     * Search for groups
     * 
     * @since   0.0.7.0
     */
    $(document).on('keyup', '.planner-bulk-schedule-search-for-groups', function () {
        
        if ( $( this ).val() === '' ) {
            
            // Hide cancel search button
            $( '.planner-bulk-schedule-cancel-search-for-groups' ).fadeOut('slow');
            
        } else {
         
            // Display cancel search button
            $( '.planner-bulk-schedule-cancel-search-for-groups' ).fadeIn('slow');
            
        }
        
        var data = {
            action: 'planner_search_groups',
            key: $( this ).val()
        };
        
        // Set CSRF
        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_search_groups');
        
    });
    
    /*
     * Submit upload form
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $( document ).on( 'change', '#file', function (e) {
        $('#upim').submit();
    }); 
    
    /*
     * Submit upload csv form
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $( document ).on( 'change', '#csvfile', function (e) {
        $('#upcsv').submit();
    }); 
    
    /*
     * Cancel search for posts
     * 
     * @since   0.0.7.5
     */     
    $( document ).on( 'click', '.planner-cancel-search-for-posts', function() {
        
        // Hide cancel search button
        $( '.planner-cancel-search-for-posts' ).fadeOut('slow');
        
        $( '.planner-search-for-posts' ).val('');        
        
        // Get posts by search
        Main.planner_all_posts(1);
        
    });
   
    /*
     * Execute action on the Planner app
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .planner-page .dropdown-menu-action a', function (e) {
        e.preventDefault();
        
        // Get the action to execute
        var action = $(this).attr('data-id');
        
        // Verify how many posts where selected
        var posts = $('.main .history-posts li .checkbox-option-select input[type="checkbox"]');
        
        var selected = [];
        
        // List all posts
        for ( var d = 0; d < posts.length; d++ ) {
            
            if ( posts[d].checked ) {
                selected.push($(posts[d]).attr('data-id'));
            }
            
        }
        
        if ( selected.length < 1 ) {
            
            // Display alert
            Main.popup_fon('sube', words.please_select_a_post, 1500, 2000);
            return;
            
        }
        
        // Verify the action
        if ( parseInt(action) === 1 ) {
            
            // Create an object with form data
            var data = {
                action: 'planner_save_posts',
                posts: Object.entries(selected)
            };

            // Set CSRF
            data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_save_posts');

            // Display loading animation
            $('.page-loading').fadeIn('slow');
            
            Main.reset_scheduled();
            
        } else if ( parseInt(action) === 3 ) {
            
            var data = {
                action: 'planner_get_all_planifications'
            };

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_get_all_planifications');

            // Show popup
            $('#planner-add-posts-to-plannification').modal('show');
            
            Main.reset_scheduled();
            
        } else {
            
            for ( var s = 0; s < selected.length; s++ ) {
            
                Main.delete_post_by_id(selected[s]);
            
            }
            
            setTimeout(function() {
            
                // Get posts by search
                Main.planner_all_posts(1);
                
            }, 1000);
            
        }

        $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-list').html(planification);
        
    });
    
    /*
     * Order posts by limit
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .planner-page .dropdown-posts-limit a', function (e) {
        e.preventDefault();
        
        // Set the new limit
        $('#dropdownDisplayedPosts').attr('data-limit', $(this).attr('data-limit'));
        
        // Set the text
        $('#dropdownDisplayedPosts').html('<i class="fas fa-sort-numeric-down"></i> ' + $(this).attr('data-limit') + ' ');
        
        // Get posts by search
        Main.planner_all_posts(1);
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });    
    
    /*
     * Display the accounts manager
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .planner-bulk-schedule-manage-members', function (e) {
        e.preventDefault();
        
        // Verify if accounts manager is open
        if ( $(this).hasClass('accounts-manager-open') ) {
            
            // Hide accounts manager
            $('.planner-bulk-schedule-accounts-manager').fadeOut('slow');
            
            // Remove open class
            $(this).removeClass('accounts-manager-open');
            
        } else {
        
            Main.account_manager_load_networks();

            // Display loading animation
            $('.page-loading').fadeIn('slow');
            
            // Add open class
            $(this).addClass('accounts-manager-open');
            
            // Show accounts manager
            $('.planner-bulk-schedule-accounts-manager').fadeIn('slow');            
        
        }
        
    });  
    
    /*
     * Cancel the post edition
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .planner-bulk-schedule-history-posts-edit-btn-cancel', function (e) {
        e.preventDefault();
        
        // Hide edit form
        $(this).closest('li').removeClass('planner-bulk-schedule-history-posts-edit');
        
    });
    
    /*
     * Displays pagination by page click
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', 'body .pagination li a', function (e) {
        e.preventDefault();
        
        // Get the page number
        var page = $(this).attr('data-page');
        
        // Display results
        switch ( $(this).closest('ul').attr('data-type') ) {
                
            case 'history-posts':
                Main.planner_all_posts(page);
                break;
            
            case 'history-posts-planify':
                Main.planner_planify_all_posts(page);
                break;
            
        }
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Select files
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #planner-new-post .upload-new-media a, .main #nav-planner-bulk-schedule-planify .upload-new-media a', function (e) {
        e.preventDefault();
        
        $('#file').click();
        
    });
    
    /*
     * Delete media
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #planner-new-post .planner-delete-media', function (e) {
        e.preventDefault();
        
        // Get media's id
        var media_id = $(this).attr('data-id');
        
        // Sae the deletion id
        Main.media.delete_id = media_id;
        
        // Prepare data to send
        var data = {
            action: 'delete_media',
            media_id: media_id,
            returns: 1
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/ajax/media', 'GET', data, 'delete_media');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });  
    
    /*
     * Load new media files
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #planner-new-post .load-new-media a', function (e) {
        e.preventDefault();
        
        // Get user's medias
        Main.planner_load_medias( ( Main.media.page + 1 ) );
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Select a media
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main .planner-bulk-schedule-history-posts-edit-media-area a.planner-select-media', function (e) {
        e.preventDefault();
        
        // Get media's id
        var media_id = $(this).attr('data-id');
        
        // Get media's url
        var media_url = $(this).attr('data-url');
        
        // Get media's type
        var media_type = $(this).attr('data-type');
        
        if ( typeof Main.selected_medias === 'undefined' ) {
            Main.selected_medias = {};
        }
        
        // Verify if the media was already selected
        if ( typeof Main.selected_medias[media_id] != 'undefined' ) {
            return;
        }

        Main.selected_medias[media_id] = {
            id: media_id,
            url: media_url,
            type: media_type
        };
        
        // Remove default cover background
        $( '.post-preview-medias' ).css('background-color','#FFFFFF');
        
        var medias = Object.values(Main.selected_medias);

        if (medias.length) {
            
            $( '.post-preview-medias' ).empty();

            for (var d = 0; d < medias.length; d++) {
                
                // Add medias in the post preview
                if ( medias[d].type === 'image' ) {

                    $( '.post-preview-medias' ).append('<div data-id="' + medias[d].id + '" data-type="' + medias[d].type + '"><img src="' + medias[d].url + '"><a href="#" class="btn-delete-post-media"><i class="icon-close"></i></a><div>');
                
                } else {
                    
                    $( '.post-preview-medias' ).append('<div data-id="' + medias[d].id + '" data-type="' + medias[d].type + '"><video controls><source src="' + medias[d].url + '" type="video/mp4"></video><a href="#" class="btn-delete-post-media"><i class="icon-close"></i></a><div>');                    
                    
                }

            }

        }
        
    });   
    
    /*
     * Delete the post's media
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $(document).on('click', '.main #planner-new-post .btn-delete-post-media', function (e) {
        e.preventDefault();

        var id = $( this ).closest( 'div' ).attr( 'data-id' );
        
        $( this ).closest( 'div' ).remove();
        
        delete Main.selected_medias[id];
        
    }); 
    
    /*
     * Detect all Posts selection
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', 'main #planner-app-select-all-posts', function (e) {
        
        setTimeout(function(){
            
            if ( $( 'main #planner-app-select-all-posts' ).is(':checked') ) {

                $( '.history-posts li input[type="checkbox"]' ).prop('checked', true);

            } else {

                $( '.history-posts li input[type="checkbox"]' ).prop('checked', false);

            }
        
        },500);
        
    });
    
    /*
     * Import posts from CSV
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', 'main .planner-import-posts-from-csv', function (e) {
        e.preventDefault();
        
        $('#csvfile').click();
        
    });
    
    /*
     * Download a CSV's example
     * 
     * @param object e with global object
     * 
     * @since   0.0.8.1
     */ 
    $( document ).on( 'click', 'main .download-csv-example', function (e) {
        e.preventDefault();
        
        // Download
        document.location.href = url + 'user/app-ajax/planner?action=export_csv';
        
    });
    
    /*
     * Delete post from the planify's modal
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .planner-bulk-schedule-history-posts-delete-btn', function (e) {
        e.preventDefault();
        
        // Get post's id
        var post_id = $(this).closest('li').attr('data-id');
        
        // Prepare data to send
        var data = {
            action: 'planner_planify_delete_post',
            type: $('#nav-planner-bulk-schedule-planify').attr('data-type'),
            post_id: post_id
        };
        
        if ( $('.main .planification_details_manage').length > 0 ) {
            data.planification_id = $('.main .planification_details_manage').attr('data-id');
        }
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_planify_delete_post');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Edit post from the planify's modal
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .planner-bulk-schedule-history-posts-edit-btn', function (e) {
        e.preventDefault();
        
        // Get post's id
        var post_id = $(this).closest('li').attr('data-id');
        
        // Hide all edit forms
        $('.main .planner-bulk-schedule-history-posts li').removeClass('planner-bulk-schedule-history-posts-edit');
        
        // Add edit post id to object
        Main.edit = {
            post_id: post_id
        };
        
        // Prepare data to send
        var data = {
            action: 'planner_planify_edit_post',
            type: $('#nav-planner-bulk-schedule-planify').attr('data-type'),
            post_id: post_id
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_planify_edit_post');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Delete post's media
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-delete-media', function (e) {
        e.preventDefault();
        
        // Get post's id
        var post_id = $(this).closest('li').attr('data-id');
        
        // Get media's id
        var media_id = $(this).attr('data-id');
        
        // Get media's type
        var media_type = $(this).closest('.single-media-select').find('.planner-select-media').attr('data-type');
        
        // Prepare data to send
        var data = {
            action: 'planner_planify_delete_post_media',
            post_id: post_id,
            media_id: media_id,
            type: media_type
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_planify_delete_post_media');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Select days
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-list .planner-bulk-schedule-planifications-list-day', function (e) {
        e.preventDefault();
        
        if ( $(this).hasClass('planner-bulk-schedule-planifications-list-day-active') ) {
            
            $(this).removeClass('planner-bulk-schedule-planifications-list-day-active');
            
        } else {
            
            $(this).addClass('planner-bulk-schedule-planifications-list-day-active');
            
        }
        
    });
    
    /*
     * Select date
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main .midrub-planner .calendar-dates a', function (e) {
        e.preventDefault();
        
        // Get date
        var date = $(this).attr('data-date');
        
        // Split date
        var parse = date.split('-');
        
        if ( Main.planify.date === 'from' ) {
            
            $(Main.planify.object).closest('.panel').find('.planner-bulk-schedule-planifications-list-date-from-full').val(parse[1] + '-' + parse[2] + '-' + parse[0]);
            $(Main.planify.object).closest('.panel').find('.planner-bulk-schedule-planifications-list-date-from').html('<i class="fas fa-calendar-alt"></i>' + parse[1] + '-' + parse[2] + '-' + parse[0] );
            
        } else {
            
            $(Main.planify.object).closest('.panel').find('.planner-bulk-schedule-planifications-list-date-to-full').val(parse[1] + '-' + parse[2] + '-' + parse[0]);
            $(Main.planify.object).closest('.panel').find('.planner-bulk-schedule-planifications-list-date-to').html('<i class="fas fa-calendar-alt"></i>' + parse[1] + '-' + parse[2] + '-' + parse[0] );
            
        }
        
        // Hide calendar
        $('.midrub-planner').fadeOut('fast');
        
        // Set current date
        Main.ctime = new Date();

        // Set current months
        Main.month = Main.ctime.getMonth() + 1;

        // Set current day
        Main.day = Main.ctime.getDate();

        // Set current year
        Main.year = Main.ctime.getFullYear();

        // Set current year
        Main.cyear = Main.year;

        // Set date/hour format
        Main.format = 0;

        // Set selected_date
        Main.selected_date = '';

        // Set selected time
        Main.selected_time = '08:00';

        // Reset scheduler
        Main.show_calendar( Main.month, Main.day, Main.year, Main.format );
        
        delete Main.planify;
        
    });  
    
    /*
     * Detect date from
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-list-date-from', function (e) {
        e.preventDefault();
        
        // Set current date
        Main.ctime = new Date();

        // Set current months
        Main.month = Main.ctime.getMonth() + 1;

        // Set current day
        Main.day = Main.ctime.getDate();

        // Set current year
        Main.year = Main.ctime.getFullYear();

        // Set current year
        Main.cyear = Main.year;

        // Set date/hour format
        Main.format = 0;

        // Set selected_date
        Main.selected_date = '';

        // Set selected time
        Main.selected_time = '08:00';

        // Reset scheduler
        Main.show_calendar( Main.month, Main.day, Main.year, Main.format );

        if ( typeof Main.planify !== 'undefined' ) {
            delete Main.planify.date;
        }
        
        Main.planify = {
            date: 'from',
            object: $(this)
        };
        
    });   
    
    /*
     * Detect date to
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-list-date-to', function (e) {
        e.preventDefault();
        
        // Set current date
        Main.ctime = new Date();

        // Set current months
        Main.month = Main.ctime.getMonth() + 1;

        // Set current day
        Main.day = Main.ctime.getDate();

        // Set current year
        Main.year = Main.ctime.getFullYear();

        // Set current year
        Main.cyear = Main.year;

        // Set date/hour format
        Main.format = 0;

        // Set selected_date
        Main.selected_date = '';

        // Set selected time
        Main.selected_time = '08:00';

        // Reset scheduler
        Main.show_calendar( Main.month, Main.day, Main.year, Main.format );
        
        if ( typeof Main.planify !== 'undefined' ) {
            delete Main.planify.date;
        }
        
        Main.planify = {
            date: 'to',
            object: $(this)
        };
        
    }); 
    
    /*
     * Change order
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-select-order-list .dropdown-item', function (e) {
        e.preventDefault();
        
        // Get type
        var type = $(this).attr('data-type');
        
        // Get name
        var name = $(this).html();
        
        // Add type
        $(this).closest('.panel').find('.planner-bulk-schedule-planifications-select-order').attr('data-type', type);
        
        // Add name
        $(this).closest('.panel').find('.planner-bulk-schedule-planifications-select-order').html(name);
        
    }); 
    
    /*
     * Change daily limit
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-select-limit-list .dropdown-item', function (e) {
        e.preventDefault();
        
        // Get type
        var type = $(this).attr('data-type');
        
        // Get name
        var name = $(this).html();
        
        // Add type
        $(this).closest('.panel').find('.planner-bulk-schedule-planifications-select-limit').attr('data-type', type);
        
        // Add name
        $(this).closest('.panel').find('.planner-bulk-schedule-planifications-select-limit').html(name);
        
    });    
    
    /*
     * Change interval
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-select-interval-list .dropdown-item', function (e) {
        e.preventDefault();
        
        // Get type
        var type = $(this).attr('data-type');
        
        // Get name
        var name = $(this).html();
        
        // Add type
        $(this).closest('.panel').find('.planner-bulk-schedule-planifications-select-interval').attr('data-type', type);
        
        // Add name
        $(this).closest('.panel').find('.planner-bulk-schedule-planifications-select-interval').html(name);
        
    });
    
    /*
     * Delete planification
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .btn-delete-planification', function (e) {
        e.preventDefault();
        
        // Remove planification
        $(this).closest('.panel').remove();
        
    }); 
    
    /*
     * New planification
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-new-planification', function (e) {
        e.preventDefault();
        
        $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-planifications-list').append(planification);
        
    });
    
    /*
     * Load accounts by network
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.2
     */ 
    $( document ).on( 'click', '.main .accounts-manager-available-networks li a', function (e) {
        e.preventDefault();
        
        var network = $(this).attr('data-network');
        
        if ( $('#nav-accounts-manager').hasClass('show') ) {
        
            $('.manage-accounts-all-accounts').empty();

            $('#nav-accounts-manager .accounts-manager-available-networks li').removeClass('network-selected');

            $(this).closest('li').addClass('network-selected');

            Main.account_manager_get_accounts(network, 'accounts_manager');
        
        } else {
            
            $( '.manage-accounts-groups-all-accounts' ).empty();
            
            $('#nav-groups-manager .accounts-manager-available-networks li').removeClass('network-selected');
            
            $(this).closest('li').addClass('network-selected');
            
            Main.account_manager_get_accounts(network, 'groups_manager');
            
        }
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    }); 
    
    /*
     * Renew session
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .accounts-manager-expired-accounts-list li a', function (e) {
        e.preventDefault();
            
        // Get the account's id
        var account_id = $(this).attr('data-id');
        
        // Get network
        var network = $('#nav-accounts-manager').find('.network-selected a').attr('data-network');
        
        var popup_url = url + 'user/connect/' + network + '?account=' + account_id;
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - ((width/2) / 2)) + dualScreenLeft;
        var top = ((height / 2) - ((height/2) / 2)) + dualScreenTop;
        var expiredWindow = window.open(popup_url, 'Pixabay', 'scrollbars=yes, width=' + (width/2) + ', height=' + (height/1.3) + ', top=' + top + ', left=' + left);

        if (window.focus) {
            expiredWindow.focus();
        }
        
    });
    
    /*
     * Connect a new account
     * 
     * @since   0.0.7.5
     */ 
    $(document).on('click', '.main .manage-accounts-new-account', function() {
        
        // Verify if should be displayed hidden content
        if ( $( this ).hasClass('manage-accounts-display-hidden-content') ) {
            $( '.main .manage-accounts-hidden-content' ).fadeIn('slow');
        } 
        
        // Get network
        var network = $('#nav-accounts-manager').find('.network-selected a').attr('data-network');
        
        var popup_url = url + 'user/connect/' + network;
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - ((width/2) / 2)) + dualScreenLeft;
        var top = ((height / 1.3) - ((height/1.3) / 1.3)) + dualScreenTop;
        var networkWindow = window.open(popup_url, 'Connect Account', 'scrollbars=yes, width=' + (width/2) + ', height=' + (height/1.3) + ', top=' + top + ', left=' + left);

        if (window.focus) {
            networkWindow.focus();
        }
        
    });
    
    /*
     * Delete accounts from the accounts manager popup
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .accounts-manager-active-accounts-list li a', function (e) {
        e.preventDefault();
            
        // Get the account's id
        var account_id = $(this).attr('data-id');

        var data = {
            action: 'account_manager_delete_accounts',
            account_id: account_id
        };

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'account_manager_delete_accounts');
        
    });
    
    /*
     * Cancel accounts manager search
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', '.main .cancel-accounts-manager-search', function (e) {
        e.preventDefault();
            
        // Hide cancel search button
        $(this).closest('.tab-pane').find('.cancel-accounts-manager-search').fadeOut('slow');
        
        // Verify if search is in the accounts tab
        if ( $(this).closest('.tab-pane').attr('id') === 'nav-accounts-manager' ) {
        
            // Get network
            var network = $('#nav-accounts-manager').find('.network-selected a').attr('data-network');

            // Empty the search input
            $('#nav-accounts-manager').find('.accounts-manager-search-for-accounts').val('');
            
            var data = {
                action: 'account_manager_search_for_accounts',
                network: network,
                key: '',
                type: 'accounts_manager'
            };

            // Set CSRF
            data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'account_manager_search_for_accounts');            
            
        } else if ( $(this).closest('.tab-pane').attr('id') === 'nav-groups-manager' ) {
            
            // Get network
            var network = $('#nav-groups-manager').find('.network-selected a').attr('data-network');
            
            // Empty the search input
            $('#nav-groups-manager').find('.accounts-manager-search-for-accounts').val('');

            var data = {
                action: 'account_manager_search_for_accounts',
                network: network,
                key: '',
                type: 'groups_manager'
            };
            
            // Set CSRF
            data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'account_manager_search_for_accounts');
            
        }
        
    });
    
    /*
     * Delete accounts from the accounts manager popup
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', 'main .accounts-manager-groups-select-group .dropdown-menu .dropdown-item', function (e) {
        e.preventDefault();
            
        // Get the group's id
        var group_id = $( this ).attr('data-id');
        
        // Add selected text
        $( 'main .accounts-manager-groups-select-group .btn-secondary' ).html( $( this ).text() );
        $( 'main .accounts-manager-groups-select-group .btn-secondary' ).attr( 'data-id', $( this ).attr('data-id') );
        
        // Remove active class
        $( 'main .accounts-manager-groups-select-group .dropdown-menu .dropdown-item' ).removeClass( 'active' );
        
        // Remove selected accounts
        $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li' ).removeClass( 'select-account-in-group' );
        
        // Add active class
        $( this ).addClass( 'active' );

        var data = {
            action: 'accounts_manager_groups_available_accounts',
            group_id: group_id
        };

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'accounts_manager_groups_available_accounts');
        
    });
    
    /*
     * Delete accounts group
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', 'main .accounts-manager-groups-select-group .accounts-manager-delete-group', function (e) {
        e.preventDefault();
            
        // Get the group's id
        var group_id = $( 'main .accounts-manager-groups-select-group .btn-secondary' ).attr( 'data-id' );
        
        var data = {
            action: 'accounts_manager_groups_delete_group',
            group_id: group_id
        };

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'accounts_manager_groups_delete_group');
        
    }); 
    
    /*
     * Add account to group
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', 'main .manage-accounts-groups-all-accounts li a', function (e) {
        e.preventDefault();
        
        // Get account id
        var account_id = $(this).attr('data-id');
        
        // Get the group's id
        var group_id = $( 'main .accounts-manager-groups-select-group .btn-secondary' ).attr( 'data-id' );
        
        var data = {
            action: 'account_manager_add_account_to_group',
            account_id: account_id,
            group_id: group_id
        };

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'account_manager_add_account_to_group');
        
    });
    
    /*
     * Remove account from group
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */ 
    $( document ).on( 'click', 'main .create-new-group-form .accounts-manager-groups-available-accounts li a', function (e) {
        e.preventDefault();
        
        // Get account id
        var account_id = $(this).attr('data-id');
        
        // Get the group's id
        var group_id = $( 'main .accounts-manager-groups-select-group .btn-secondary' ).attr( 'data-id' );
        
        var data = {
            action: 'account_manager_remove_account_from_group',
            account_id: account_id,
            group_id: group_id
        };

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'account_manager_remove_account_from_group');
        
    });
    
    /*
     * Cancel search for accounts
     * 
     * @since   0.0.7.0
     */     
    $( document ).on( 'click', '.planner-bulk-schedule-cancel-search-for-accounts', function() {
        
        // Hide cancel search button
        $( '.planner-bulk-schedule-cancel-search-for-accounts' ).fadeOut('slow');        
        
        if ( $('.composer-search-for-groups').length > 0 ) {
            
            $('.composer-search-for-groups').val('');
        
            var data = {
                action: 'composer_search_groups',
                key: $( this ).val()
            };
            
            // Set CSRF
            data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'composer_groups_results_by_search');
        
        } else {
            
            $('.planner-bulk-schedule-search-for-accounts').val('');

            var data = {
                action: 'planner_search_accounts',
                key: ''
            };

            // Set CSRF
            data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_accounts_results_by_search');
        
        }
        
    });
    
    /*
     * Select account in the composer tab
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.0
     */
    $(document).on('click', '.planner-bulk-schedule-accounts-list li a', function (e) {
        e.preventDefault();
        
        // Verify if selected_post_accounts is defined
        if ( typeof Main.selected_post_accounts === 'undefined' ) {
            Main.selected_post_accounts = {};
        }
        
        // Get network
        var network = $( this ).attr( 'data-network' );
        
        // Get category option
        var category = $( this ).attr( 'data-category' );        
        
        // Get account's id
        var network_id = $( this ).attr( 'data-id' );
        
        // Get net's id
        var net_id = $( this ).attr( 'data-net' );
        
        // Define accounts count
        if ( typeof Main.selected_accounts === 'undefined' ) {
            Main.selected_accounts = 0;
        }

        // Verify if account was selected
        if ( $( this ).closest( 'li' ).hasClass( 'account-selected' ) ) {

            var post_accounts = JSON.parse(Main.selected_post_accounts[network]);

            if ( post_accounts.length ) {
                
                delete Main.selected_post_accounts[network];
                
                for (var d = 0; d < post_accounts.length; d++) {

                    if ( post_accounts[d] === network_id ) {
                        
                        var selected = $( '.planner-bulk-schedule-colapse-selected-accounts-list a[data-id="' + post_accounts[d] + '"]' );
                        
                        selected.closest( 'li' ).remove();
                        
                        delete post_accounts[d];
                        
                    } else {
                        
                        if ( typeof Main.selected_post_accounts[network] !== 'undefined' ) {

                            var extract = JSON.parse(Main.selected_post_accounts[network]);

                            if ( extract.indexOf(post_accounts[d]) < 0 ) {

                                extract[extract.length] = post_accounts[d];
                                Main.selected_post_accounts[network] = JSON.stringify(extract);

                            }

                        } else {

                            Main.selected_post_accounts[network] = JSON.stringify([post_accounts[d]]);

                        }
                        
                    }

                }

            }
            
            $( this ).closest( 'li' ).removeClass( 'account-selected' );
            
            Main.selected_accounts--;
            
        } else {

            if ( typeof Main.selected_post_accounts[network] !== 'undefined' ) {

                var extract = JSON.parse(Main.selected_post_accounts[network]);

                if ( extract.indexOf(network_id) < 0 ) {

                    extract[extract.length] = network_id;
                    Main.selected_post_accounts[network] = JSON.stringify(extract);
                    
                    $( '<li>' + $( this ).closest( 'li' ).html() + '</li>' ).appendTo( '.planner-bulk-schedule-colapse-selected-accounts-list ul' );

                }

            } else {

                Main.selected_post_accounts[network] = JSON.stringify([network_id]);
                
                $( '<li>' + $( this ).closest( 'li' ).html() + '</li>' ).appendTo( '.planner-bulk-schedule-colapse-selected-accounts-list ul' );

            }
                
            $( this ).closest( 'li' ).addClass( 'account-selected' );
            
            Main.selected_accounts++;
            
        }
        
        $('.planner-bulk-schedule-colapse-selected-accounts-count').html(Main.selected_accounts + ' ' + words.selected_accounts);
        
    });
    
    /*
     * Unselect account or group
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $(document).on('click', '.planner-bulk-schedule-colapse-selected-accounts-list ul li a', function (e) {
        e.preventDefault();
        
        if ( $('.main .planner-bulk-schedule-groups-list').length > 0 ) {
        
            // Remove selected account
            $( this ).closest( 'li' ).remove();

             // Empty selected group
            Main.selected_post_group = {};

            // Remove selected group
            $( '.main .planner-bulk-schedule-groups-list li').removeClass( 'group-selected' );

            $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html('0 ' + words.selected_groups);
        
        } else {
        
            // Get account's id
            var network_id = $( this ).attr( 'data-id' );

            // Get network
            var network = $( this ).attr( 'data-network' );

            // Remove selected account
            $( this ).closest( 'li' ).remove();

            // Get account from the list
            var selected = $( '.planner-bulk-schedule-accounts-list li a[data-id="' + network_id + '"]' );        

            // Verify if account was selected
            if ( selected.closest( 'li' ).length > 0 ) {

                selected.closest( 'li' ).removeClass( 'account-selected' );

            }

            var post_accounts = JSON.parse(Main.selected_post_accounts[network]);

            if (post_accounts.length) {

                delete Main.selected_post_accounts[network];

                for (var d = 0; d < post_accounts.length; d++) {

                    if (post_accounts[d] === network_id) {

                        var selected = $('.planner-bulk-schedule-colapse-selected-accounts-list a[data-id="' + post_accounts[d] + '"]');

                        selected.closest('li').remove();

                        delete post_accounts[d];

                    } else {

                        if (typeof Main.selected_post_accounts[network] !== 'undefined') {

                            var extract = JSON.parse(Main.selected_post_accounts[network]);

                            if (extract.indexOf(post_accounts[d]) < 0) {

                                extract[extract.length] = post_accounts[d];
                                Main.selected_post_accounts[network] = JSON.stringify(extract);

                            }

                        } else {

                            Main.selected_post_accounts[network] = JSON.stringify([post_accounts[d]]);

                        }

                    }

                }

            }
            
            Main.selected_accounts--;

            $('.planner-bulk-schedule-colapse-selected-accounts-count').html(Main.selected_accounts + ' ' + words.selected_accounts);
            
        }
        
    });
    
    /*
     * Show planification details
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main .fc-h-event', function() {
        
        var data = {
            action: 'planner_get_planification',
            planification_id: $(this).attr('data-id'),
            meta_id: $(this).attr('data-meta')
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_get_planification');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Show planification's scheduled post
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main .planner-bulk-schedule-scheduling-post-delete-btn', function() {
        
        // Get meta's id
        var meta_id = $(this).closest('li').attr('data-id');
        
        var data = {
            action: 'planner_delete_planification_rule_meta',
            meta_id: meta_id
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_delete_planification_rule_meta');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Show deletion planification's options
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main .delete-planification', function() {
        
        $('.main .confirm').show();
        
    }); 
    
    /*
     * Hide deletion planification's options
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main .confirm .no', function(e) {
        e.preventDefault();
        
        $('.main .confirm').hide();
        
    });    
    
    /*
     * Delete a planification
     * 
     * @since   0.0.7.5
     */    
    $( document ).on( 'click', '.main .confirm .yes', function(e) {
        e.preventDefault();
        
        // Get planification's id
        var planification_id = $(this).closest('.planification_details_manage').attr('data-id');
        
        var data = {
            action: 'planner_delete_planification',
            planification_id: planification_id
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'GET', data, 'planner_delete_planification');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });     
    
    /*
     * Select group in the composer tab
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.0
     */
    $(document).on('click', '.planner-bulk-schedule-groups-list li a', function (e) {
        e.preventDefault();
        
        if ( $( this ).closest('li').hasClass('group-selected') ) {

            // Define $this
            var $this = $(this);

            // Remove selected group
            $this.closest( 'ul' ).find('li').removeClass( 'group-selected' );            
            
            // Empty selected group
            delete Main.selected_post_group;  
            
            $( '.main .planner-bulk-schedule-colapse-selected-accounts-list ul' ).empty();
            
            $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html('0 ' + words.selected_groups);
            
        } else {
        
            // Get group's id
            var group_id = $( this ).attr( 'data-id' );

            // Define $this
            var $this = $(this);

            // Empty selected group
            Main.selected_post_group = {};

            // Remove selected group
            $this.closest( 'ul' ).find('li').removeClass( 'group-selected' );

            // Add group-selected class
            $this.closest( 'li' ).addClass('group-selected');

            // Add group's id
            Main.selected_post_group = $this.attr('data-id');

            $( '.main .planner-bulk-schedule-colapse-selected-accounts-list ul' ).empty();

            $( '<li>' + $this.closest( 'li' ).html() + '</li>' ).appendTo( '.main .planner-bulk-schedule-colapse-selected-accounts-list ul' );   
            
            $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html('1 ' + words.selected_groups);
            
        }
        
    });   
    
    /*
     * Cancel search for groups
     * 
     * @since   0.0.7.5
     */     
    $( document ).on( 'click', '.main .planner-bulk-schedule-cancel-search-for-groups', function() {
        
        // Hide cancel search button
        $( '.planner-bulk-schedule-cancel-search-for-groups' ).fadeOut('slow');
            
        $('.planner-bulk-schedule-search-for-groups').val('');

        var data = {
            action: 'planner_search_groups',
            key: $( this ).val()
        };

        // Set CSRF
        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_search_groups');
        
    });
    
    /*
     * Save the VK token
     * 
     * @param object e with global object
     * 
     * @since   0.0.0.1
     */ 
    $( document ).on( 'click', 'main .save-token', function (e) {

        var $this = $(this);
        var network = $('#nav-accounts-manager').find('.network-selected a').attr('data-network');
        var token = $this.closest('.manage-accounts-hidden-content').find('.token').val();
        var encode = btoa(token);
        encode = encode.replace('/', '-');
        var cleanURL = encode.replace(/=/g, '');
        
        $.ajax({
            url: url + 'user/save-token/' + network + '/' + cleanURL,
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                
                if (data === 1) {
                    
                    $this.closest('.manage-accounts-hidden-content').find('.token').val('');
                    
                    $( '.main .manage-accounts-hidden-content' ).fadeOut('fast');
                    
                    Main.reload_accounts();
                    
                } else {
                    
                    $this.closest('.manage-accounts-hidden-content').find('.token').val('');
                    
                    // Display alert
                    Main.popup_fon('sube', data, 1500, 2000);
                    
                }
                
            },
            error: function (data, jqXHR, textStatus) {
                console.log(data);
            }
            
        });
        
    });
    
    /*
     * Change the Planification's category
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.7
     */ 
    $( document ).on( 'click', '.main .dropdown-categories-list a', function (e) {
        e.preventDefault();
        
        // Get category's ID
        var category_id = $(this).attr('data-id');
        
        // Set category's ID
        $('.main .dropdown-selected-category').attr('data-id', category_id);
        
        // Set category's name
        $('.main .dropdown-selected-category').html($(this).html());
        
    });
   
    /*******************************
    RESPONSES
    ********************************/
   
    /*
     * Display social networks
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.account_manager_load_networks = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            $( '#nav-accounts-manager' ).html( data.social_data );
            
            $( '#nav-groups-manager' ).html( data.groups_data );
            
        }
        
    };
    
    /*
     * Display all saved posts
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_display_all_posts = function ( status, data ) {

        //alert("test response");

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            var allposts = '';

            Main.pagination.page = data.page;
            Main.show_planner_pagination('#planner-posts-list', data.total, $('#dropdownDisplayedPosts').attr('data-limit'));

            for (var u = 0; u < data.posts.length; u++) {
                
                // Set post content
                var text = data.posts[u].body.substring(0, 130) + ' ...';

                // Add post
                allposts += '<li>'
                                + '<div class="row">'
                                    + '<div class="col-xl-12">'
                                        + '<div class="checkbox-option-select">'
                                            + '<input id="planner-single-post-' + data.posts[u].post_id + '" name="planner-single-post-' + data.posts[u].post_id + '" type="checkbox" data-id="' + data.posts[u].post_id + '">'
                                            + '<label for="planner-single-post-' + data.posts[u].post_id + '"></label>'
                                        + '</div>'
                                        + '<h4>'
                                            + text
                                        + '</h4>'
                                    + '</div>'
                                + '</div>'
                            + '</li>';

            }

            $('.history-posts').html(allposts);
            
            $('.main #planner-app-select-all-posts').prop( 'checked', false );
            
        } else {
            
            $('.panel-body .pagination').empty();
            
            $('.history-posts').html('<li class="no-posts-found">' + data.message + '</li>');
            
        }
        
    };
    
    /*
     * Display all saved planner_planify_display_all_posts displays posts in the planify's modal
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_planify_display_all_posts = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            Main.pagination.page = data.page;
            Main.show_pagination('#nav-planner-bulk-schedule-planify', data.total);
            
            var allposts = '';

            for (var u = 0; u < data.posts.length; u++) {
                
                // Set post content
                var text = data.posts[u].body.substring(0, 110) + ' ...';
                
                var media = '';

                if ( $('.main .dropdown-selected-category').length < 1 ) {

                    media = '<div class="form-group planner-bulk-schedule-history-posts-edit-media-head">'
                                + '<h3>'
                                    + words.post_media_files
                                + '</h3>'
                            + '</div>'
                            + '<div class="form-group planner-bulk-schedule-history-posts-edit-media-area">'
                            + '</div>';

                }
                    
                // Add post
                allposts += '<li data-id="' + data.posts[u].post_id + '">'
                                + '<div class="row">'
                                    + '<div class="col-xl-9">'
                                        + '<h4>'
                                            + text
                                        + '</h4>'
                                    + '</div>'
                                    + '<div class="col-xl-3 text-right">'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-history-posts-delete-btn">'
                                            + '<i class="icon-trash"></i>'
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-history-posts-edit-btn">'
                                            + '<i class="icon-pencil"></i>'
                                        + '</button>'
                                    + '</div>'
                                + '</div>'
                                + '<div class="row">'
                                    + '<form method="POST" class="planner-bulk-schedule-history-posts-edit-form">'
                                        + '<div class="form-group">'
                                            + '<input type="text" class="form-control planner-planify-post-title" placeholder="' + words.post_title + '">'
                                        + '</div>'
                                        + '<div class="form-group">'
                                            + '<input type="text" class="form-control planner-planify-post-url" placeholder="' + words.post_url + '">'
                                        + '</div>'
                                        + '<div class="form-group">'
                                            + '<textarea class="form-control planner-planify-post-body" placeholder="' + words.post_body + '"></textarea>'
                                        + '</div>'
                                        + media
                                        + '<div class="form-group text-right">'
                                            + '<button type="submit" class="btn btn-danger btn-default planner-bulk-schedule-history-posts-edit-btn-cancel"><i class="fas fa-ban"></i>' + words.cancel + '</button>'
                                            + '<button type="submit" class="btn btn-primary"><i class="far fa-save"></i>' + words.save + '</button>'
                                        + '</div>'
                                    + '</form>'
                                + '</div>'
                            + '</li>';                    

            }
            
            // Display posts
            $('.planner-bulk-schedule-history-posts').html(allposts); 
            
        } else {
            
            $('.panel-body .pagination').empty();
            
            $('.planner-bulk-schedule-history-posts').html('<li class="no-posts-found">' + data.message + '</li>');
            
            if ( $('#nav-planner-bulk-schedule-planify').attr('data-type') === 'planify-posts-modal' ) {
                
                // Hide popup
                $('#planner-bulk-schedule').modal('hide');
                
            }
            
        }

    };
    
    /*
     * Display save post status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_save_post = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Reset form
            $('.planner-new-post-form')[0].reset();
            
            $('.emojionearea-editor, .post-preview-medias').empty();
            
            // Get posts by search
            Main.planner_all_posts(1);
            
            // Remove tag styles
            $('.post-preview-medias').removeAttr('style');
            
            // Delete selected medias
            if ( typeof Main.selected_post_accounts !== 'undefined' ) {
                delete Main.selected_post_accounts;
            }
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
    
    };
    
    /*
     * Display save posts status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_save_posts = function ( status, data ) {
        
        // Remove category's ID
        $('.main .dropdown-selected-category').removeAttr('data-id');

        // Restore Categories
        $('.main .dropdown-selected-category').html('<i class="fas fa-grip-horizontal"></i> ' + words.categories);

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            var allposts = '';

            if ( data.total > 10 ) {

                $('#nav-planner-bulk-schedule-planify .pagination').show();
                Main.pagination.page = data.page;
                Main.show_pagination('#nav-planner-bulk-schedule-planify', data.total);
            
            } else {
                
                $('#nav-planner-bulk-schedule-planify .pagination').hide();
                
            }
            
            $('.main .planner-bulk-schedule-accounts-list ul li').removeClass('account-selected');
            $('.main .planner-bulk-schedule-colapse-selected-accounts-list ul').empty();
            $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html('0 ' + words.selected_accounts);
            $('.main .planner-bulk-schedule-planification-title input[type="text"]').val('');

            for (var u = 0; u < data.posts.length; u++) {
                
                // Set post content
                var text = data.posts[u].body.substring(0, 110) + ' ...';
                
                var media = '';

                if ( $('.main .dropdown-selected-category').length < 1 ) {

                    media = '<div class="form-group planner-bulk-schedule-history-posts-edit-media-head">'
                                + '<h3>'
                                    + words.post_media_files
                                + '</h3>'
                            + '</div>'
                            + '<div class="form-group planner-bulk-schedule-history-posts-edit-media-area">'
                            + '</div>';

                }
                    
                // Add post
                allposts += '<li data-id="' + data.posts[u].post_id + '">'
                                + '<div class="row">'
                                    + '<div class="col-xl-9">'
                                        + '<h4>'
                                            + text
                                        + '</h4>'
                                    + '</div>'
                                    + '<div class="col-xl-3 text-right">'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-history-posts-delete-btn">'
                                            + '<i class="icon-trash"></i>'
                                        + '</button>'
                                        + '<button type="button" class="btn btn-default planner-bulk-schedule-history-posts-edit-btn">'
                                            + '<i class="icon-pencil"></i>'
                                        + '</button>'
                                    + '</div>'
                                + '</div>'
                                + '<div class="row">'
                                    + '<form method="POST" class="planner-bulk-schedule-history-posts-edit-form">'
                                        + '<div class="form-group">'
                                            + '<input type="text" class="form-control planner-planify-post-title" placeholder="' + words.post_title + '">'
                                        + '</div>'
                                        + '<div class="form-group">'
                                            + '<input type="text" class="form-control planner-planify-post-url" placeholder="' + words.post_url + '">'
                                        + '</div>'
                                        + '<div class="form-group">'
                                            + '<textarea class="form-control planner-planify-post-body" placeholder="' + words.post_body + '"></textarea>'
                                        + '</div>'
                                        + media
                                        + '<div class="form-group text-right">'
                                            + '<button type="submit" class="btn btn-danger btn-default planner-bulk-schedule-history-posts-edit-btn-cancel"><i class="fas fa-ban"></i>' + words.cancel + '</button>'
                                            + '<button type="submit" class="btn btn-primary"><i class="far fa-save"></i>' + words.save + '</button>'
                                        + '</div>'
                                    + '</form>'
                                + '</div>'
                            + '</li>';                    

            }
            
            // Display posts
            $('.planner-bulk-schedule-history-posts').html(allposts);
            
            // Set modal's type
            $('.main #nav-planner-bulk-schedule-planify').attr('data-type', 'planify-posts-modal');
            $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-accounts-manager').hide();
            $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-manage-members').removeClass('accounts-manager-open');
            
            // Uncheck all checkboxes
            $( '.history-posts li input[type="checkbox"]' ).prop('checked', false);
            $( '#planner-app-select-all-posts' ).prop('checked', false);
            
            // Open popup
            $('#planner-bulk-schedule').modal('show');
            
            // Open Planify tab
            $('.main #planner-bulk-schedule-planify-tab').click();
            
            $('.main #nav-planner-bulk-schedule-planifications').html('<p class="no_planifications_found">' + words.no_posts_found + '</p>');  
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);            
            
        }
    
    };
    
    /*
     * Display deletion media status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.delete_media = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            if (Main.media.page === 1) {
                
                // Verify if deletion id exists
                if ( typeof Main.media.delete_id !== 'undefined' ) {
                    
                    // Delete from preview
                    $('.main .post-preview-medias > div[data-id="' + Main.media.delete_id + '"]').remove();

                    delete Main.media.delete_id;
                    
                }
            
                // Get user's medias
                Main.planner_load_medias(1);
                
            } else {
                
                // Verify if deletion id exists
                if ( typeof Main.media.delete_id !== 'undefined' ) {
                    
                    // Remove div
                    $('.main #planner-new-post .planner-bulk-schedule-history-posts-edit-media-area div a[data-id="' + Main.media.delete_id + '"]').closest('div').remove();
                    
                    // Delete from preview
                    $('.main #planner-new-post .post-preview-medias > div[data-id="' + Main.media.delete_id + '"]').remove();

                    delete Main.media.delete_id;
                    
                }
                
            }
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
    
    };
    
    /*
     * Get user's medias
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.get_media = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            var medias = '';

            if (Main.media.page === 1) {

                medias = '<div class="upload-new-media">'
                            + '<a href="#">'
                                + '<i class="icon-cloud-upload"></i>'
                            + '</a>'
                        + '</div>';

                for (var m = 0; m < data.medias.length; m++) {

                    medias += '<div class="single-media-select">'
                                + '<a href="#" data-id="' + data.medias[m].media_id + '" class="planner-delete-media">'
                                    + '<i class="icon-close"></i>'
                                + '</a>'                                
                                + '<a href="#" data-id="' + data.medias[m].media_id + '" data-type="' + data.medias[m].type + '" data-url="' + data.medias[m].body + '" class="planner-select-media">'
                                    + '<img src="' + data.medias[m].cover + '">'
                                + '</a>'
                            + '</div>';

                }    
                
                if ( data.total >= (Main.media.page * 16 ) ) {
                
                    medias += '<div class="load-new-media">'
                                + '<a href="#">'
                                    + '<i class="icon-reload"></i>'
                                + '</a>'
                            + '</div>';
                
                }

                $('.main #planner-new-post .planner-bulk-schedule-history-posts-edit-media-area').html(medias);

            } else {
                
                for (var m = 0; m < data.medias.length; m++) {

                    medias += '<div class="single-media-select">'
                                + '<a href="#" data-id="' + data.medias[m].media_id + '" class="planner-delete-media">'
                                    + '<i class="icon-close"></i>'
                                + '</a>'                                
                                + '<a href="#" data-id="' + data.medias[m].media_id + '" data-type="' + data.medias[m].type + '" data-url="' + data.medias[m].body + '" class="planner-select-media">'
                                    + '<img src="' + data.medias[m].cover + '">'
                                + '</a>'
                            + '</div>';

                }    
                
                $('.main #planner-new-post .planner-bulk-schedule-history-posts-edit-media-area').find('.load-new-media').remove();
                
                if ( data.total >= (Main.media.page * 16 ) ) {
                
                    medias += '<div class="load-new-media">'
                                + '<a href="#">'
                                    + '<i class="icon-reload"></i>'
                                + '</a>'
                            + '</div>';
                
                }

                $('.main #planner-new-post .planner-bulk-schedule-history-posts-edit-media-area').append(medias);
                
            }
            
        } else {
            
            if ( $('.main #planner-new-post .planner-bulk-schedule-history-posts-edit-media-area .single-media-select').length < 1 ) {
            
                var medias = '<div class="upload-new-media">'
                                + '<a href="#">'
                                    + '<i class="icon-cloud-upload"></i>'
                                + '</a>'
                            + '</div>';

                $('.main #planner-new-post .planner-bulk-schedule-history-posts-edit-media-area').html(medias);
                
            }
            
        }
    
    };
    
    /*
     * Display post deletion response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_delete_post_by_id = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
    
    };
    
    /*
     * Display post deletion response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_planify_delete_post = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            if ( typeof data.post_id === 'undefined' ) {
                
                // Close modal
                $('#planner-bulk-schedule').modal('hide');

                $('#calendar').fullCalendar('removeEventSources'); 
                var parsed_date = new Date();
                var new_date = new Date(Date.parse(parsed_date.getFullYear() + '-' + (parsed_date.getMonth() + 1) + '-01 00:00:00'));
                var start = new_date.getTime()/1000;

                Main.scheduled_events(start,(start+3456000)); 
                
            } else {
            
                // Load all posts
                Main.planner_planify_all_posts(1);
            
            }
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
    
    };
    
    /*
     * Display post edition response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_planify_edit_post = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Enable emojies
            $( '.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"] #planner-planify-post-title-' + data.post.post_id ).emojioneArea({
                pickerPosition: 'bottom',
                tonesStyle: 'bullet',
                attributes: {
                    spellcheck: true,
                    autocomplete: 'on'
                }

            });
        
            // Display edit form
            $('.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"]').addClass('planner-bulk-schedule-history-posts-edit');
            
            // Add title
            $('.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"]').find('.planner-planify-post-title').val(data.post.title);

            $('.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"]').find('.emojionearea-editor').html(data.post.body);

            $('.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"]').find('.planner-planify-post-body').val(data.post.body);
            
            // Add url
            $('.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"]').find('.planner-planify-post-url').val(data.post.url);
            
            // Add body id
            $('.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"]').find('.planner-planify-post-body').attr('id', 'planner-planify-post-title-' + data.post.post_id);
            
            var medias = '<div class="upload-new-media">'
                            + '<a href="#">'
                                + '<i class="icon-cloud-upload"></i>'
                            + '</a>'
                        + '</div>';
            
            var imgs = data.post.img;
            
            for ( var d = 0; d < imgs.length; d++ ) {
                
                medias += '<div class="single-media-select">'
                            + '<a href="#" data-id="' + imgs[d].media_id + '" class="planner-delete-media">'
                                + '<i class="icon-close"></i>'
                            + '</a>'                                
                            + '<a href="#" data-id="' + imgs[d].media_id + '" data-type="image" data-url="' + imgs[d].body + '" class="planner-select-media">'
                                + '<img src="' + imgs[d].cover + '">'
                            + '</a>'
                        + '</div>';
                
            }
            
            var videos = data.post.video;
            
            for ( var v = 0; v < videos.length; v++ ) {
                
                medias += '<div class="single-media-select">'
                            + '<a href="#" data-id="' + videos[v].media_id + '" class="planner-delete-media">'
                                + '<i class="icon-close"></i>'
                            + '</a>'                                
                            + '<a href="#" data-id="' + videos[v].media_id + '" data-type="video" data-url="' + videos[v].body + '" class="planner-select-media">'
                                + '<img src="' + videos[v].cover + '">'
                            + '</a>'
                        + '</div>';
                
            }
            
            // Add medias
            $('.main .planner-bulk-schedule-history-posts li[data-id="' + Main.edit.post_id + '"]').find('.planner-bulk-schedule-history-posts-edit-media-area').html(medias);
            
            // Delete post id
            delete Main.edit.post_id;
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
    
    };
    
    /*
     * Display media deletion response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_planify_delete_post_media = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            var medias = '<div class="upload-new-media">'
                            + '<a href="#">'
                                + '<i class="icon-cloud-upload"></i>'
                            + '</a>'
                        + '</div>';
            
            var imgs = data.post.img;
            
            for ( var d = 0; d < imgs.length; d++ ) {
                
                medias += '<div class="single-media-select">'
                            + '<a href="#" data-id="' + imgs[d].media_id + '" class="planner-delete-media">'
                                + '<i class="icon-close"></i>'
                            + '</a>'                                
                            + '<a href="#" data-id="' + imgs[d].media_id + '" data-type="image" data-url="' + imgs[d].body + '" class="planner-select-media">'
                                + '<img src="' + imgs[d].cover + '">'
                            + '</a>'
                        + '</div>';
                
            }
            
            var videos = data.post.video;
            
            for ( var v = 0; v < videos.length; v++ ) {
                
                medias += '<div class="single-media-select">'
                            + '<a href="#" data-id="' + videos[v].media_id + '" class="planner-delete-media">'
                                + '<i class="icon-close"></i>'
                            + '</a>'                                
                            + '<a href="#" data-id="' + videos[v].media_id + '" data-type="video" data-url="' + videos[v].body + '" class="planner-select-media">'
                                + '<img src="' + videos[v].cover + '">'
                            + '</a>'
                        + '</div>';
                
            }
            
            // Add medias
            $('.main .planner-bulk-schedule-history-posts li[data-id="' + data.post.post_id + '"]').find('.planner-bulk-schedule-history-posts-edit-media-area').html(medias);
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }

    };
    
    /*
     * Display posts medias response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_planify_add_post_media = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {

            var medias = '<div class="upload-new-media">'
                            + '<a href="#">'
                                + '<i class="icon-cloud-upload"></i>'
                            + '</a>'
                        + '</div>';
            
            var imgs = data.post.img;
            
            for ( var d = 0; d < imgs.length; d++ ) {
                
                medias += '<div class="single-media-select">'
                            + '<a href="#" data-id="' + imgs[d].media_id + '" class="planner-delete-media">'
                                + '<i class="icon-close"></i>'
                            + '</a>'                                
                            + '<a href="#" data-id="' + imgs[d].media_id + '" data-type="image" data-url="' + imgs[d].body + '" class="planner-select-media">'
                                + '<img src="' + imgs[d].cover + '">'
                            + '</a>'
                        + '</div>';
                
            }
            
            var videos = data.post.video;
            
            for ( var v = 0; v < videos.length; v++ ) {
                
                medias += '<div class="single-media-select">'
                            + '<a href="#" data-id="' + videos[v].media_id + '" class="planner-delete-media">'
                                + '<i class="icon-close"></i>'
                            + '</a>'                                
                            + '<a href="#" data-id="' + videos[v].media_id + '" data-type="video" data-url="' + videos[v].body + '" class="planner-select-media">'
                                + '<img src="' + videos[v].cover + '">'
                            + '</a>'
                        + '</div>';
                
            }
            
            // Add medias
            $('.main .planner-bulk-schedule-history-posts li[data-id="' + data.post.post_id + '"]').find('.planner-bulk-schedule-history-posts-edit-media-area').html(medias);
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 3000);
            
        }

    }; 
    
    /*
     * Display post update response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_update_a_post = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Get text
            var post = $('.main .planner-bulk-schedule-history-posts li.planner-bulk-schedule-history-posts-edit').find('.planner-planify-post-body').val();
            
            // Add preview
            $('.main .planner-bulk-schedule-history-posts li.planner-bulk-schedule-history-posts-edit .col-xl-9 h4').html(post.substring(0, 110) + ' ...');
            
            // Hide all edit forms
            $('.main .planner-bulk-schedule-history-posts li').removeClass('planner-bulk-schedule-history-posts-edit');
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }

    };
    
    /*
     * Display network's accounts
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.account_manager_get_accounts = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            if ( data.type === 'accounts_manager' ) {
                
                // Verify if hidden content exists
                if ( data.hidden ) {
                    $( '.main .manage-accounts-hidden-content' ).html(data.hidden);
                } else {
                    $( '.main .manage-accounts-hidden-content' ).empty();
                }
                
                $( '.main .manage-accounts-hidden-content' ).fadeOut('fast');
            
                // Display accounts
                $( '#planner-bulk-schedule .manage-accounts-all-accounts' ).html(data.active);

                // Display network's instructions
                $( '#planner-bulk-schedule .manage-accounts-network-instructions' ).html(data.instructions);

                // Display search form
                $( '#planner-bulk-schedule .manage-accounts-search-form' ).html(data.search_form);
            
            } else {
                
                // Display accounts
                $( '#planner-bulk-schedule .manage-accounts-groups-all-accounts' ).html(data.active);

                if ( $('.accounts-manager-groups-select-group .btn-secondary').attr('data-id') ) {
                    
                    // Remove selected accounts
                    $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li' ).removeClass( 'select-account-in-group' );
                    
                    var group_accounts = $('main .create-new-group-form .accounts-manager-groups-available-accounts li');

                    for ( var g = 0; g < group_accounts.length; g++ ) {
                        
                        $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li a[data-id="' + group_accounts.eq(g).find('a').attr('data-id') + '"]' ).closest( 'li' ).addClass( 'select-account-in-group' );
                        
                    }
                    
                }
                
            }
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
        
    };
    
    /*
     * Display account deletion status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.account_manager_delete_accounts = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);

            // Remove account from the list
            $('#nav-accounts-manager .accounts-manager-active-accounts-list li a[data-id="' + data.account_id + '"]').closest('li').remove();
            
            Main.reload_accounts_list();
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
        
    };
    
    /*
     * Display search results in accounts manager
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.account_manager_search_for_accounts = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            if ( data.type === 'accounts_manager' ) {

                $( document ).find( '#nav-accounts-manager .manage-accounts-all-accounts' ).html( data.social_data );
                
            } else {
                
                $( document ).find( '#nav-groups-manager .manage-accounts-groups-all-accounts' ).html( data.social_data );
                
            }
            
        } else {
            
            if ( $('#nav-accounts-manager').hasClass('show') ) {
                
                $( document ).find('#nav-accounts-manager .manage-accounts-all-accounts').html( data.message );
                
            } else {
                
                $( document ).find( '#nav-groups-manager .manage-accounts-groups-all-accounts' ).html( data.social_data );
                
            }         
            
        }
        
        if ( $('.accounts-manager-groups-select-group .btn-secondary').attr('data-id') ) {

            // Remove selected accounts
            $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li' ).removeClass( 'select-account-in-group' );

            var group_accounts = $('main .create-new-group-form .accounts-manager-groups-available-accounts li');

            for ( var g = 0; g < group_accounts.length; g++ ) {

                $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li a[data-id="' + group_accounts.eq(g).find('a').attr('data-id') + '"]' ).closest( 'li' ).addClass( 'select-account-in-group' );

            }

        }
        
    };
    
    /*
     * Display group creation status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.account_manager_create_accounts_group = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Empty the group name field
            $('.accounts-manager-groups-enter-group-name').val('');
            
            // Get groups
            var groups = data.groups;
            
            var all_groups = '';
            
            var groups_list = '';
            
            for ( var w = 0; w < groups.length; w++ ) {
                
                all_groups += '<button class="dropdown-item" type="button" data-id="' + groups[w].list_id + '">'
                                + groups[w].name
                            + '</button>';
                
                var group_selected = '';
                
                if ( typeof Main.selected_post_group !== 'undefined' ) {

                    if ( Main.selected_post_group === groups[w].list_id ) {
                        group_selected = ' class="group-selected"';
                    }
                
                }
                
                groups_list += '<li' + group_selected + '>'
                                + '<a href="#" data-id="' + groups[w].list_id + '">'
                                    + '<i class="icon-folder-alt"></i>'
                                    + groups[w].name
                                    + '<i class="icon-check"></i>'
                                + '</a>'
                            + '</li>';
                
            }
            
            $( '.planner-bulk-schedule-groups-list ul' ).html( groups_list );
            
            $( document ).find( '.create-new-group-form .dropdown-menu' ).html( all_groups );
            
            $( document ).find( '.create-new-group-form .dropdown-menu button[data-id="' + data.group_id + '"]' ).click();
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
        
    };
    
    /*
     * Gets all available group's accounts
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.accounts_manager_groups_available_accounts = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            var accounts = '';

            for ( var a = 0; a < data.accounts.length; a++ ) {
                
                $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li a[data-id="' + data.accounts[a].network_id + '"]' ).closest( 'li' ).addClass( 'select-account-in-group' );
                
                accounts += '<li>'
                                + '<a href="#" data-id="' + data.accounts[a].network_id + '">' + data.accounts[a].user_name + ' <i class="icon-trash"></i></a>'
                            + '</li>';
                
            }
            
            // Display accounts
            $('.main #nav-groups-manager .accounts-manager-groups-available-accounts').html( accounts );
            
        } else {
            
            var accounts = '<li class="no-accounts-found">'
                                + data.message
                            + '</li>';
            
            // Display no accounts found message
            $('.main #nav-groups-manager .accounts-manager-groups-available-accounts').html( accounts );
            
        }
        
        $( '.main .accounts-manager-groups-select-group .col-xl-12' ).eq(1).fadeIn('slow');
        $( '.main .accounts-manager-groups-select-group .col-xl-12' ).eq(2).fadeIn('slow');
        
    };
    
    /*
     * Display group deletion status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.accounts_manager_groups_delete_group = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Change the selector text
            $('.accounts-manager-groups-select-group .btn-secondary').text(data.select_group);
            $('.accounts-manager-groups-select-group .btn-secondary').removeAttr('data-id');
            
            // Remove active class
            $( 'main .accounts-manager-groups-select-group .dropdown-menu .dropdown-item' ).removeClass( 'active' );
            $( 'main .accounts-manager-groups-active-accounts li' ).removeClass( 'select-account-in-group' );
            
            // Hide accounts and deletion button area
            $('.accounts-manager-groups-select-group .accounts-manager-groups-available-accounts').empty();
            $( '.main .accounts-manager-groups-select-group .col-xl-12' ).eq(1).fadeOut('slow');
            $( '.main .accounts-manager-groups-select-group .col-xl-12' ).eq(2).fadeOut('slow');
            
            // Get groups
            var groups = data.groups;
            
            var all_groups = '';
            
            var groups_list = '';
            
            for ( var w = 0; w < groups.length; w++ ) {
                
                all_groups += '<button class="dropdown-item" type="button" data-id="' + groups[w].list_id + '">'
                                + groups[w].name
                            + '</button>';
                    
                var group_selected = '';
                
                if ( typeof Main.selected_post_group !== 'undefined' ) {

                    if ( Main.selected_post_group === groups[w].list_id ) {
                        group_selected = ' class="group-selected"';
                    }
                
                }
                
                groups_list += '<li' + group_selected + '>'
                                + '<a href="#" data-id="' + groups[w].list_id + '">'
                                    + '<i class="icon-folder-alt"></i>'
                                    + groups[w].name
                                    + '<i class="icon-check"></i>'
                                + '</a>'
                            + '</li>';
                
            }
            
            $( '.planner-bulk-schedule-groups-list ul' ).html( groups_list );
            
            $( document ).find( '.create-new-group-form .dropdown-menu' ).html( all_groups );
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
        
    };
    
    /*
     * Display adding account to grup status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.account_manager_add_account_to_group = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Remove selected accounts
            $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li' ).removeClass( 'select-account-in-group' );
            
            var accounts = '';
            
            for ( var a = 0; a < data.accounts.length; a++ ) {
                
                $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li a[data-id="' + data.accounts[a].network_id + '"]' ).closest( 'li' ).addClass( 'select-account-in-group' );
                
                accounts += '<li>'
                                    + '<a href="#" data-id="' + data.accounts[a].network_id + '">'
                                        + data.accounts[a].user_name + ' <i class="icon-trash"></i>'
                                    + '</a>'
                                + '</li>';
                
            }
            
            $( document ).find( '.create-new-group-form .accounts-manager-groups-available-accounts' ).html( accounts );
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
        
    };
    
    /*
     * Removing account from a group response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.account_manager_remove_account_from_group = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            if (typeof data.accounts === 'string' || data.accounts instanceof String) {
                
                accounts = data.accounts;
                
            } else {
                
                // Remove selected accounts
                $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li' ).removeClass( 'select-account-in-group' );
            
                var accounts = '';

                for ( var a = 0; a < data.accounts.length; a++ ) {
                    
                    $( '.main #nav-groups-manager .accounts-manager-groups-active-accounts li a[data-id="' + data.accounts[a].network_id + '"]' ).closest( 'li' ).addClass( 'select-account-in-group' );

                    accounts += '<li>'
                                    + '<a href="#" data-id="' + data.accounts[a].network_id + '">'
                                        + data.accounts[a].user_name + ' <i class="icon-trash"></i>'
                                    + '</a>'
                                + '</li>';

                }
            
            }
            
            $( document ).find( '.create-new-group-form .accounts-manager-groups-available-accounts' ).html( accounts );
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }
        
    };
    
    /*
     * Display accounts results
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_accounts_results_by_search = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            var accounts = '';
            
            // List all accounts
            for ( var f = 0; f < data.accounts_list.length; f++ ) {
                
                var icon = data.accounts_list[f].network_info.icon;
                
                var new_icon = icon.replace(' class', ' style="color: ' + data.accounts_list[f].network_info.color + '" class');
                
                var account_selected = '';
                
                if ( typeof Main.selected_post_accounts !== 'undefined' ) {
                
                    if (typeof Main.selected_post_accounts[data.accounts_list[f].network_name] !== 'undefined') {

                        var extract = JSON.parse(Main.selected_post_accounts[data.accounts_list[f].network_name]);

                        if (extract.indexOf(data.accounts_list[f].network_id) > -1) {
                            account_selected = ' class="account-selected"';
                        }

                    }
                
                }
                
                accounts += '<li' + account_selected + '>'
                                + '<a href="#" data-id="' + data.accounts_list[f].network_id + '" data-net="' + data.accounts_list[f].net_id + '" data-network="' + data.accounts_list[f].network_name + '" data-category="' + data.accounts_list[f].network_info.categories + '">'
                                    + new_icon
                                    + data.accounts_list[f].user_name
                                    + '<i class="icon-check"></i>'
                                + '</a>'
                            + '</li>';
                
            }
            
            $( '.planner-bulk-schedule-accounts-list ul' ).html( accounts );
            
        } else {
            
            $( '.planner-bulk-schedule-accounts-list ul' ).html( '<li class="no-accounts-found">' + data.message + '</li>' );
            
        }

    };
    
     /*
     * Display groups results
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_search_groups = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            var groups = '';
            
            // List all accounts
            for ( var f = 0; f < data.groups_list.length; f++ ) {
                
                var group_selected = '';
                
                if ( typeof Main.selected_post_group !== 'undefined' ) {

                    if ( Main.selected_post_group === data.groups_list[f].list_id ) {
                        group_selected = ' class="group-selected"';
                    }
                
                }
                
                groups += '<li' + group_selected + '>'
                                + '<a href="#" data-id="' + data.groups_list[f].list_id + '">'
                                    + '<i class="icon-folder-alt"></i>'
                                    + data.groups_list[f].name
                                    + '<i class="icon-check"></i>'
                                + '</a>'
                            + '</li>';
                
            }
            
            $( '.planner-bulk-schedule-groups-list ul' ).html( groups );
            
        } else {
            
            $( '.planner-bulk-schedule-groups-list ul' ).html( '<li class="no-groups-found">' + data.message + '</li>' );
            
        }

    };
    
    /*
     * Display planification status
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_save_planification = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Remove selected accounts
            $( '.main .planner-bulk-schedule-accounts-list li').removeClass( 'account-selected' );
            
            // Remove temporary posts
            $( '.main .planner-bulk-schedule-history-posts').empty();
            
            // Remove all planifications rules
            $( '.main .planner-bulk-schedule-planifications-list').empty();
            
            // Empty the planification's title
            $('.main .planner-bulk-schedule-planification-title input[type="text"]').val('');
            
            if ( $('.main .planner-bulk-schedule-groups-list').length > 0 ) {

                // Remove groups number
                $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html('0 ' + words.selected_groups);

            } else {

                // Remove accounts number
                $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html('0 ' + words.selected_accounts);

            }
            
            if ( $('.main .dropdown-selected-category').length > 0 ) {
                
                if (typeof $('.main .dropdown-selected-category').attr('data-id') !== typeof undefined && $('.main .dropdown-selected-category').attr('data-id') !== false) {
                
                    // Remove category's ID
                    $('.main .dropdown-selected-category').removeAttr('data-id');
                    
                    // Restore Categories
                    $('.main .dropdown-selected-category').html('<i class="fas fa-grip-horizontal"></i> ' + words.categories);
                
                }
        
            }
            
            // Remove all selected social accounts
            $( '.main .planner-bulk-schedule-colapse-selected-accounts-list ul' ).empty();
            
            setTimeout(function(){
                // Open popup
                $('#planner-bulk-schedule').modal('hide');
            }, 1000);
            
            $('#calendar').fullCalendar('removeEventSources'); 
            var parsed_date = new Date();
            var new_date = new Date(Date.parse(parsed_date.getFullYear() + '-' + (parsed_date.getMonth() + 1) + '-01 00:00:00'));
            var start = new_date.getTime()/1000;

            Main.scheduled_events(start,(start+3456000)); 
            
            Main.reset_scheduled();
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }

    };
    
    /*
     * Display planifications
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_display_all_planifications = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
      
            $('#calendar').fullCalendar('removeEventSources'); 
            
            var events = [];

            if (data.all_planifications.length) {

                for (var d = 0; d < data.all_planifications.length; d++) {

                    events.push({
                        title: '<p><i class="icon-clock"></i>' + data.all_planifications[d].title + '</p>',
                        start: data.all_planifications[d].datetime,
                        ido: data.all_planifications[d].planification_id,
                        meta_id: data.all_planifications[d].meta_id
                    });

                }

            }

            $('#calendar').fullCalendar('addEventSource', events);
            
        }

    };  
    
    /*
     * Display planification
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_get_planification = function ( status, data ) {
        
        // Remove category's ID
        $('.main .dropdown-selected-category').removeAttr('data-id');

        // Restore Categories
        $('.main .dropdown-selected-category').html('<i class="fas fa-grip-horizontal"></i> ' + words.categories);

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            if ( data.planification_data[0].category_id ) {

                // Set category's ID
                $('.main .dropdown-selected-category').attr('data-id', data.planification_data[0].category_id);

                // Set category's name
                $('.main .dropdown-selected-category').html($('.main .dropdown-categories-list > a[data-id="' + data.planification_data[0].category_id + '"]').html());
                
            }
            
            // Open popup
            $('#planner-bulk-schedule').modal('show');
            
            Main.reset_scheduled();
            
            // Open Planify tab
            $('.main #planner-bulk-schedule-planify-tab').click();

            $('.main .planner-bulk-schedule-planification-title input[type="text"]').val(data.planification_data[0].title);
            
            // Set modal's type
            $('.main #nav-planner-bulk-schedule-planify').attr('data-type', 'planify-planned-posts-modal');
            $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-accounts-manager').hide();
            $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-manage-members').removeClass('accounts-manager-open');
            
            var allposts = '';

            if ( data.planification_posts_total > 0 ) { 
                
                Main.pagination.page = data.page;
                Main.show_pagination('.planner-bulk-schedule-posts-list', data.planification_posts_total);

                for (var u = 0; u < data.planification_posts.length; u++) {

                    // Set post content
                    var text = data.planification_posts[u].body.substring(0, 110) + ' ...';
                    
                    var media = '';
                    
                    if ( $('.main .dropdown-selected-category').length < 1 ) {
                        
                        media = '<div class="form-group planner-bulk-schedule-history-posts-edit-media-head">'
                                    + '<h3>'
                                        + words.post_media_files
                                    + '</h3>'
                                + '</div>'
                                + '<div class="form-group planner-bulk-schedule-history-posts-edit-media-area">'
                                + '</div>';
                        
                    }

                    // Add post
                    allposts += '<li data-id="' + data.planification_posts[u].post_id + '">'
                                    + '<div class="row">'
                                        + '<div class="col-xl-9">'
                                            + '<h4>'
                                                + text
                                            + '</h4>'
                                        + '</div>'
                                        + '<div class="col-xl-3 text-right">'
                                            + '<button type="button" class="btn btn-default planner-bulk-schedule-history-posts-delete-btn">'
                                                + '<i class="icon-trash"></i>'
                                            + '</button>'
                                            + '<button type="button" class="btn btn-default planner-bulk-schedule-history-posts-edit-btn">'
                                                + '<i class="icon-pencil"></i>'
                                            + '</button>'
                                        + '</div>'
                                    + '</div>'
                                    + '<div class="row">'
                                        + '<form method="POST" class="planner-bulk-schedule-history-posts-edit-form">'
                                            + '<div class="form-group">'
                                                + '<input type="text" class="form-control planner-planify-post-title" placeholder="' + words.post_title + '">'
                                            + '</div>'
                                            + '<div class="form-group">'
                                                + '<input type="text" class="form-control planner-planify-post-url" placeholder="' + words.post_url + '">'
                                            + '</div>'
                                            + '<div class="form-group">'
                                                + '<textarea class="form-control planner-planify-post-body" placeholder="' + words.post_body + '"></textarea>'
                                            + '</div>'                            
                                            + media
                                            + '<div class="form-group text-right">'
                                                + '<button type="submit" class="btn btn-danger btn-default planner-bulk-schedule-history-posts-edit-btn-cancel"><i class="fas fa-ban"></i>' + words.cancel + '</button>'
                                                + '<button type="submit" class="btn btn-primary"><i class="far fa-save"></i>' + words.save + '</button>'
                                            + '</div>'
                                        + '</form>'
                                    + '</div>'
                                + '</li>';                    

                }
                
            } else {
                
                $('.panel-body .pagination').empty();
                
            }
            
            // Display posts
            $('.planner-bulk-schedule-history-posts').html(allposts);
            
            // Get all rules
            var planification_rules = data.planification_rules;
            
            var rules = '';
            
            for ( var p = 0; p < planification_rules.length; p++ ) {
                
                var mon = '';
                
                if ( parseInt(planification_rules[p].mon) > 0 ) {
                    mon = ' planner-bulk-schedule-planifications-list-day-active';
                }
                
                var sun = '';
                
                if ( parseInt(planification_rules[p].sun) > 0 ) {
                    sun = ' planner-bulk-schedule-planifications-list-day-active';
                }
                
                var tue = '';
                
                if ( parseInt(planification_rules[p].tue) > 0 ) {
                    tue = ' planner-bulk-schedule-planifications-list-day-active';
                }
                
                var wed = '';
                
                if ( parseInt(planification_rules[p].wed) > 0 ) {
                    wed = ' planner-bulk-schedule-planifications-list-day-active';
                }
                
                var thu = '';
                
                if ( parseInt(planification_rules[p].thu) > 0 ) {
                    thu = ' planner-bulk-schedule-planifications-list-day-active';
                } 
                
                var fri = '';
                
                if ( parseInt(planification_rules[p].fri) > 0 ) {
                    fri = ' planner-bulk-schedule-planifications-list-day-active';
                }  
                
                var sat = '';
                
                if ( parseInt(planification_rules[p].sat) > 0 ) {
                    sat = ' planner-bulk-schedule-planifications-list-day-active';
                }
                
                var order = words.ordered;
                var order_type = 1;
                
                if ( parseInt(planification_rules[p].plan_order) > 1 ) {
                    order = words.random;
                    order_type = 1;
                }
                
                var limit = planification_rules[p].plan_limit;
                
                var interval = words.exact_interval;
                var interval_type = 1;
                
                if ( parseInt(planification_rules[p].plan_interval) > 1 ) {
                    interval = words.random_interval;
                    interval_type = 2;
                }
                
                rules += '<div class="panel panel-default active-rule" data-id="' + planification_rules[p].rule_id + '">'
                                        + '<div class="panel-heading">'
                                            + '<div class="row">'
                                                + '<div class="col-xl-4">'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day' + sun + '" data-type="7">'
                                                        + words.sun
                                                    + '</button>'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day' + mon + '" data-type="1">'
                                                        + words.mon
                                                    + '</button>'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day' + tue + '" data-type="2">'
                                                        + words.tue
                                                    + '</button>'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day' + wed + '" data-type="3">'
                                                        + words.wed
                                                    + '</button>'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day' + thu + '" data-type="4">'
                                                        + words.thu
                                                    + '</button>'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day' + fri + '" data-type="5">'
                                                        + words.fri
                                                    + '</button>'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-day' + sat + '" data-type="6">'
                                                        + words.sat
                                                    + '</button>'
                                                + '</div>'
                                                + '<div class="col-xl-2">'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-date-from open-midrub-planner">'
                                                        + '<i class="fas fa-calendar-alt"></i>'
                                                        + planification_rules[p].date_from
                                                    + '</button>'
                                                    + '<input type="hidden" class="planner-bulk-schedule-planifications-list-date-from-full" value="' + planification_rules[p].date_from + '">'
                                                + '</div>'
                                                + '<div class="col-xl-2">'
                                                    + '<i class="fas fa-arrows-alt-h"></i>'
                                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-planifications-list-date-to open-midrub-planner">'
                                                        + '<i class="fas fa-calendar-alt"></i>'
                                                        + planification_rules[p].date_to
                                                    + '</button>'
                                                    + '<input type="hidden" class="planner-bulk-schedule-planifications-list-date-to-full" value="' + planification_rules[p].date_to + '">'
                                                + '</div>'
                                                + '<div class="col-xl-2">'
                                                    + '<div class="planner-bulk-schedule-planifications-list-time">'
                                                        + '<i class="icon-clock"></i>'
                                                        + planification_time('from', planification_rules[p].time_from)
                                                    + '</div>'
                                                + '</div>'
                                                + '<div class="col-xl-2">'
                                                    + '<i class="fas fa-arrows-alt-h"></i>'
                                                    + '<div class="planner-bulk-schedule-planifications-list-time">'
                                                        + '<i class="icon-clock"></i>'
                                                        + planification_time('to', planification_rules[p].time_to)
                                                    + '</div>'                                  
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                        + '<div class="panel-body">'
                                            + '<hr>'
                                            + '<div class="row">'
                                                + '<div class="col-xl-3">'
                                                    + '<div class="dropdown">'
                                                        + '<button class="btn btn-secondary planner-bulk-schedule-planifications-select-order dropdown-toggle" data-type="' + order_type + '" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                            + '<i class="fas fa-sort-alpha-down"></i>'
                                                            + order
                                                        + '</button>'
                                                        + '<div class="dropdown-menu planner-bulk-schedule-planifications-select-order-list" aria-labelledby="dropdownMenu1">'
                                                            + '<button class="dropdown-item" data-type="1" type="button">'
                                                                + '<i class="fas fa-sort-alpha-down"></i>'
                                                                + words.ordered
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="2" type="button">'
                                                                + '<i class="fas fa-sort-alpha-down"></i> '
                                                                + words.random
                                                            + '</button>'
                                                        + '</div>'
                                                    + '</div>'
                                                + '</div>'
                                                + '<div class="col-xl-3">'
                                                    + '<div class="dropdown">'
                                                        + '<button class="btn btn-secondary planner-bulk-schedule-planifications-select-limit dropdown-toggle" data-type="' + limit + '" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                            + '<i class="far fa-share-square"></i>'
                                                            + limit + ' ' + words.posts_daily
                                                        + '</button>'
                                                        + '<div class="dropdown-menu planner-bulk-schedule-planifications-select-limit-list" aria-labelledby="dropdownMenu2">'
                                                            + '<button class="dropdown-item" data-type="1" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '1 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="2" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '2 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="3" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '3 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="4" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '4 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="5" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '5 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="6" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '6 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="7" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '7 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="8" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '8 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="9" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '9 ' + words.posts_daily
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="10" type="button">'
                                                                + '<i class="far fa-share-square"></i>'
                                                                + '10 ' + words.posts_daily
                                                            + '</button>'
                                                        + '</div>'
                                                    + '</div>'
                                                + '</div>'
                                                + '<div class="col-xl-3">'
                                                    + '<div class="dropdown">'
                                                        + '<button class="btn btn-secondary planner-bulk-schedule-planifications-select-interval dropdown-toggle" data-type="' + interval_type + '" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                            + '<i class="fas fa-sort"></i>'
                                                            + interval
                                                        + '</button>'
                                                        + '<div class="dropdown-menu planner-bulk-schedule-planifications-select-interval-list" aria-labelledby="dropdownMenu3">'
                                                            + '<button class="dropdown-item" data-type="1" type="button">'
                                                                + '<i class="fas fa-sort"></i>'
                                                                + words.exact_interval
                                                            + '</button>'
                                                            + '<button class="dropdown-item" data-type="2" type="button">'
                                                                + '<i class="fas fa-sort"></i>'
                                                                + words.random_interval
                                                            + '</button>'
                                                        + '</div>'
                                                    + '</div>'
                                                + '</div>'
                                                + '<div class="col-xl-3">'
                                                    + '<button type="button" class="btn btn-delete-planification" data-id="3334">'
                                                        + '<i class="icon-trash"></i> ' + words.delet
                                                    + '</button>'
                                                + '</div>'
                                            + '</div>'
                                        + '</div>'
                                    + '</div>';
                
            }
            
            $('.planner-bulk-schedule-planifications-list').html(rules);
            
            $('.main .planner-bulk-schedule-colapse-selected-accounts-list ul').empty();
            
            if ( $('.main .planner-bulk-schedule-groups-list').length > 0 ) {
                
                $('.main .planner-bulk-schedule-groups-list ul li').removeClass('group-selected');
                
                var group_id = 0;
                
                if ( data.planification_data[0].group_id > 0 ) {
                    
                    if ( $('.main .planner-bulk-schedule-groups-list ul li a[data-id="' + data.planification_data[0].group_id + '"]') ) {
                        $('.main .planner-bulk-schedule-groups-list ul li a[data-id="' + data.planification_data[0].group_id + '"]').closest('li').addClass('group-selected');
                    }
                    
                    group_id = 1;
                    
                    var group = '<li>'
                                    + '<a href="#" data-id="' + data.planification_data[0].group_id + '">'
                                        + '<i class="icon-folder-alt"></i>'
                                            + data.planification_data[0].name
                                        + '<i class="icon-check"></i>'
                                    + '</a>'
                                + '</li>';
                        
                    $('.main .planner-bulk-schedule-colapse-selected-accounts-list ul').html(group);  
                        
                }
                
                $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html(group_id + ' ' + words.selected_groups);
                
                // Empty selected group
                Main.selected_post_group = {};

                // Add group's id
                Main.selected_post_group = data.planification_data[0].group_id;
                
            } else {
                
                // Get all networks
                var planification_networks = data.planification_networks;
                
                $('.planner-bulk-schedule-accounts-list li').removeClass('account-selected');

                var networks = '';
                
                Main.selected_accounts = data.planification_networks.length;

                for ( var n = 0; n < data.planification_networks.length; n++ ) {

                    if ( $('.planner-bulk-schedule-accounts-list li a[data-id="' + data.planification_networks[n].network_id + '"]') ) {
                        $('.planner-bulk-schedule-accounts-list li a[data-id="' + data.planification_networks[n].network_id + '"]').closest('li').addClass('account-selected');
                    }

                    // Verify if selected_post_accounts is defined
                    if ( typeof Main.selected_post_accounts === 'undefined' ) {
                        Main.selected_post_accounts = {};
                    }

                    // Define accounts count
                    if (typeof Main.selected_accounts === 'undefined') {
                        Main.selected_accounts = data.planification_networks.length;
                    }

                    if (typeof Main.selected_post_accounts[data.planification_networks[n].network_name] !== 'undefined') {

                        var extract = JSON.parse(Main.selected_post_accounts[data.planification_networks[n].network_name]);

                        if (extract.indexOf(data.planification_networks[n].network_id) < 0) {

                            extract[extract.length] = data.planification_networks[n].network_id;
                            Main.selected_post_accounts[data.planification_networks[n].network_name] = JSON.stringify(extract);

                        }

                    } else {

                        Main.selected_post_accounts[data.planification_networks[n].network_name] = JSON.stringify([data.planification_networks[n].network_id]);

                    }
                    
                    networks += '<li>'
                                    + '<a href="#" data-id="' + data.planification_networks[n].network_id + '" data-net="' + data.planification_networks[n].net_id + '" data-network="' + data.planification_networks[n].network_name + '" data-category="value">'
                                        + data.planification_networks[n].network_icon
                                        + data.planification_networks[n].user_name
                                        + '<i class="icon-check"></i>'
                                    + '</a>'
                                + '</li>';

                    $('.main .planner-bulk-schedule-colapse-selected-accounts-list ul').html(networks);  

                }
                
                $('.main .planner-bulk-schedule-colapse-selected-accounts-count').html(data.planification_networks.length + ' ' + words.selected_accounts); 
                
            }
            
            var posts = '';
            
            for ( var n = 0; n < data.planification_rules_metas.length; n++ ) {
                
                var exact_time = data.planification_rules_metas[n].exact_date;

                if ( $( '.main .planner-page' ).attr('data-date-format') === '12' ) {

                        var time = exact_time.split(':');

                        if ( time[0] > 12 ) {

                            var n_time = parseInt(time[0]) - 12;

                            if ( n_time < 10 ) {

                                var sel = '0' + n_time;

                            } else {

                                var sel = n_time;

                            }

                            var format = 'PM';

                        } else {

                            var format = 'AM';

                            sel = time[0];

                        }

                        exact_time = sel + ':' + time[1] + ' ' + format;

                }
                
                posts += '<li data-id="' + data.planification_rules_metas[n].meta_id + '">'
                            + '<div class="row">'
                                + '<div class="col-xl-9 col-7">'
                                    + '<h4>'
                                        + data.planification_rules_metas[n].body
                                    + '</h4>'
                                + '</div>'
                                + '<div class="col-xl-3 col-5 text-right">'
                                    + '<span>'
                                        + '<i class="far fa-clock"></i>'
                                        + exact_time
                                    + '</span>'
                                    + '<button type="button" class="btn btn-default planner-bulk-schedule-scheduling-post-delete-btn">'
                                        + '<i class="icon-trash"></i>'
                                    + '</button>'
                                + '</div>'
                            + '</div>'
                        + '</li>';
                
            }
            
            var manage = '<div class="planification_details_manage" data-id="' + data.planification_data[0].planification_id + '">'
                            + '<button type="button" class="btn btn-danger delete-planification">'
                                + '<i class="icon-trash"></i>'
                                + words.delete_planification
                            + '</button>'
                            + '<p class="pull-left confirm">' + words.are_you_sure
                                + ' <a href="#" class="delete-user-account yes">'
                                    + words.yes
                                + '</a>'
                                + '<a href="#" class="no">'
                                    + words.no
                                + '</a>'
                            + '</p>'
                        + '</div>';
            
            $('.main #nav-planner-bulk-schedule-planifications').html('<ul>' + posts + '</ul>' + manage);            
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }

    };  
    
    /*
     * Display planned post deletion response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_delete_planification_rule_meta = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            if ( typeof data.meta_id === 'undefined' ) {
                
                // Close modal
                $('#planner-bulk-schedule').modal('hide');

                $('#calendar').fullCalendar('removeEventSources'); 
                var parsed_date = new Date();
                var new_date = new Date(Date.parse(parsed_date.getFullYear() + '-' + (parsed_date.getMonth() + 1) + '-01 00:00:00'));
                var start = new_date.getTime()/1000;

                Main.scheduled_events(start,(start+3456000)); 
                
            } else {
            
                // Hide the planned post
                $('.main #nav-planner-bulk-schedule-planifications ul li[data-id="' + data.meta_id + '"]').remove();
            
            }
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }

    };
    
    /*
     * Display planification deletion response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_delete_planification = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Close modal
            $('#planner-bulk-schedule').modal('hide');
            
            $('#calendar').fullCalendar('removeEventSources'); 
            var parsed_date = new Date();
            var new_date = new Date(Date.parse(parsed_date.getFullYear() + '-' + (parsed_date.getMonth() + 1) + '-01 00:00:00'));
            var start = new_date.getTime()/1000;

            Main.scheduled_events(start,(start+3456000)); 
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }

    };
    
    /*
     * Displays all planifications
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_get_all_planifications = function ( status, data ) {
        
        $( '.main .planner-select-planification' ).html( data.planifications );

    };
    
    /*
     * Adding posts to planification response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.5
     */
    Main.methods.planner_add_planification_posts = function ( status, data ) {

        // Verify if the success response exists
        if ( status === 'success' ) {
            
            // Display alert
            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Uncheck all checkboxes
            $( '.history-posts li input[type="checkbox"]' ).prop('checked', false);
            $( '#planner-app-select-all-posts' ).prop('checked', false);

            $('#planner-add-posts-to-plannification').modal('hide');
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', data.message, 1500, 2000);
            
        }

    };
   
    /*******************************
    FORMS
    ********************************/
    
    /*
     * Publish a post
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5 
     */
    $('.planner-new-post-form').submit(function (e) {

        alert("Test");
        
        e.preventDefault();

        // Set current time
        var currentdate = new Date();
        
        // Get title
        var post_title = $('.planner-new-post-post-title').val(); 
        
        // Get post's body
        var post = btoa(encodeURIComponent($('.planner-new-post-post-body').val()));
        
        // Remove non necessary characters
        post = post.replace('/', '-');
        post = post.replace(/=/g, '');
        
        // Get url
        var post_url = $('.planner-new-post-post-url').val();  
        
        // Default networks
        var networks = [];
        
        // Default group
        var group_id = [];
        
        if ( typeof Main.selected_medias !== 'undefined' ) {
            // Set medias
            var medias = Object.values(Main.selected_medias);
        } else {
            var medias = [];
        }  

        // Set default status
        var status = 0;
        
        // Create an object with form data
        var data = {
            action: 'planner_save_post',
            post: post,
            post_title: post_title,
            url: post_url,
            medias: medias,
            networks: networks,
            group_id: group_id,
            publish: status
        };
        
        // Set CSRF
        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_save_post');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*
     * Upload medias
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $('#upim').submit(function (e) {
        e.preventDefault();
        
        var files = $('#file')[0].files;
        
        if ( typeof files[0] !== 'undefined' ) {
            
            Main.saveFile(files[0]);
            
        }
        
    });
    
    /*
     * Upload a csv file
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $('#upcsv').submit(function (e) {
        e.preventDefault();
        
        var files = $('#csvfile')[0].files;
        
        if ( typeof files[0] !== 'undefined' ) {
            
            Main.saveCsvFile(files[0]);
            
        }
        
    }); 
    
    /*
     * Update a post
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $(document).on('submit', '.main .planner-bulk-schedule-history-posts-edit-form', function (e) {
        e.preventDefault();
        
        // Get post's id
        var post_id = $(this).closest('li').attr('data-id');
        
        // Get title
        var title = $(this).find('.planner-planify-post-title').val();
        
        // Get post's url
        var post_url = $(this).find('.planner-planify-post-url').val();
        
        // Get body
        var body = $(this).find('.planner-planify-post-body').val();
        
        var data = {
            action: 'planner_update_a_post',
            post_id: post_id,
            title: title,
            url: post_url,
            body: body
        };

        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_update_a_post');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    }); 
    
    /*
     * Create a group
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $(document).on('submit', '.main .create-new-group-form', function (e) {
        e.preventDefault();
        
        // Get the group name
        var group_name = $('.main .accounts-manager-groups-enter-group-name').val();
        
        // Create an object with form data
        var data = {
            action: 'account_manager_create_accounts_group',
            group_name: group_name
        };
        
        // Set CSRF
        data[$('.main .create-new-group-form').attr('data-csrf')] = $('input[name="' + $('.main .create-new-group-form').attr('data-csrf') + '"]').val();
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'account_manager_create_accounts_group');
        
        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
   
    /*
     * Save the planification
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $(document).on('submit', '.main .planify-save-panifications', function (e) {
        e.preventDefault();
        
        // Get title
        var title = $(this).find('.planner-bulk-schedule-planification-title input[type="text"]').val();
        
        // Get all rules
        var rules = $(this).find('.planner-bulk-schedule-planifications-list .panel');
        
        // Verify if the planification has rules
        if ( rules.length > 0 ) {
            
            // Define the planification's rules array
            var planification_rules = [];
            
            for ( var r = 0; r < rules.length; r++ ) {
                
                // Get days
                var days = $(rules).eq(r).find('.panel-heading .planner-bulk-schedule-planifications-list-day');
                
                var selected_days = [];
                
                for ( var e = 0; e < days.length; e++ ) {
                    
                    if ( $(days).eq(e).hasClass('planner-bulk-schedule-planifications-list-day-active') ) {

                        selected_days.push($(days).eq(e).attr('data-type'));
                        
                    }
                    
                }
                
                if ( selected_days.length < 1 ) {
                    
                    // Display alert
                    Main.popup_fon('sube', words.no_days_selected, 1500, 2000);
                    return;
                    
                } else {
                    
                    // Get date from
                    var date_from = $(rules).eq(r).find('.panel-heading .planner-bulk-schedule-planifications-list-date-from-full').val();
                    
                    // Get date to
                    var date_to = $(rules).eq(r).find('.panel-heading .planner-bulk-schedule-planifications-list-date-to-full').val();  
                    
                    if ( (new Date(date_to).getTime()/1000) - (new Date(date_from).getTime()/1000) < 0 ) {
                        
                        // Display alert
                        Main.popup_fon('sube', words.range_time_at_least_1_day, 1500, 2000);
                        return;
                        
                    } else {
                        
                        var hour_from = parseInt($(rules).eq(r).find('.panel-heading .midrub-calendar-time-hour-from').val());
                        
                        var time_from = $(rules).eq(r).find('.panel-heading .midrub-calendar-time-minutes-from').val();
                        
                        if ( $(rules).eq(r).find('.panel-heading .midrub-calendar-time-period-from').length > 0 ) {
                            
                            var period = $(rules).eq(r).find('.panel-heading .midrub-calendar-time-period-from').val();
                            
                            if (period === 'PM') {

                                hour_from = 12 + parseInt(hour_from);

                            }
                            
                        }
                        
                        var hour_to = parseInt($(rules).eq(r).find('.panel-heading .midrub-calendar-time-hour-to').val());
                        
                        var time_to = $(rules).eq(r).find('.panel-heading .midrub-calendar-time-minutes-to').val();
                        
                        if ( $(rules).eq(r).find('.panel-heading .midrub-calendar-time-period-to').length > 0 ) {
                            
                            var period = $(rules).eq(r).find('.panel-heading .midrub-calendar-time-period-to').val();
                            
                            if (period === 'PM') {

                                hour_to = 12 + parseInt(hour_to);

                            }
                            
                        }
                        
                        // Get order
                        var order = $(rules).eq(r).find('.panel-body .planner-bulk-schedule-planifications-select-order').attr('data-type');
                        
                        // Get limit
                        var limit = $(rules).eq(r).find('.panel-body .planner-bulk-schedule-planifications-select-limit').attr('data-type');
                        
                        // Get interval
                        var interval = $(rules).eq(r).find('.panel-body .planner-bulk-schedule-planifications-select-interval').attr('data-type');
                        
                        var data = {
                            selected_days: selected_days,
                            date_from: date_from,
                            date_to: date_to,
                            hour_from: hour_from,
                            time_from: time_from,
                            hour_to: hour_to,
                            time_to: time_to,
                            order: order,
                            limit: limit,
                            interval: interval
                        };
                        
                        if ( $(rules).eq(r).hasClass('active-rule') ) {
                            data.rule_id = $(rules).eq(r).attr('data-id');
                        }
                        
                        planification_rules.push(data);
                        
                    }
                    
                }
                
            }
            
            if ( $('.main .planner-bulk-schedule-groups-list').length > 0 ) {
                
                // Verify if group was selected
                if ( typeof Main.selected_post_group === 'undefined' ) {

                    // Display alert
                    Main.popup_fon('sube', words.please_select_group, 1500, 2000);  
                    return;

                }                
                
            } else {
            
                // Verify if accounts were selected
                if ( typeof Main.selected_post_accounts === 'undefined' ) {

                    // Display alert
                    Main.popup_fon('sube', words.please_select_at_least_one_account, 1500, 2000);  
                    return;

                }
            
            }
            
            // Verify if selected posts exists
            if ( $('.main #nav-planner-bulk-schedule-planify .planner-bulk-schedule-history-posts li').length < 1 ) {
                
                // Display alert
                Main.popup_fon('sube', words.no_post_to_planify, 1500, 2000);  
                return;
                
            }
            
            if ( typeof Main.selected_post_group !== 'undefined' ) {

                // Set group's id
                var group_id = Main.selected_post_group;

            } else {

                var group_id = [];

            }
            
            if ( typeof Main.selected_post_accounts !== 'undefined' ) {
                
                // Set networks
                var networks = Main.selected_post_accounts;
                
            } else {
                
                var networks = [];
                
            }
            
            // Set current time
            var currentdate = new Date();

            // Set date time
            var datetime = currentdate.getFullYear() + '-' + (currentdate.getMonth() + 1) + '-' + currentdate.getDate() + ' ' + currentdate.getHours() + ':' + currentdate.getMinutes() + ':' + currentdate.getSeconds();

            // Create an object with form data
            var data = {
                action: 'planner_save_planification',
                title: title,
                planification_rules: planification_rules,
                networks: networks,
                group_id: group_id,
                current_date: datetime
            };
            
            if ( $('.main .planification_details_manage').length > 0 ) {
                data.planification_id = $('.main .planification_details_manage').attr('data-id');
            }
            
            if ( $('.main .dropdown-selected-category').length > 0 ) {
                
                if (typeof $('.main .dropdown-selected-category').attr('data-id') !== typeof undefined && $('.main .dropdown-selected-category').attr('data-id') !== false) {
                
                    // Get category's ID
                    data['category_id'] = $('.main .dropdown-selected-category').attr('data-id');
                
                }
        
            }            

            // Set CSRF
            data[$('.main .planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.main .planner-new-post-form').attr('data-csrf') + '"]').val();

            // Make ajax call
            Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_save_planification');

            // Display loading animation
            $('.page-loading').fadeIn('slow');
            
        } else {
            
            // Display alert
            Main.popup_fon('sube', words.at_least_planification_rule, 1500, 2000);
            
        }
        
    });
    
    /*
     * Adds post to a planification
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.5
     */
    $(document).on('submit', '.main .add-posts-to-planification', function (e) {
        e.preventDefault();
        
        // Get selected planification
        var planification_id = $( this ).find( '.planner-select-planification' ).val();
        
        // Verify how many posts where selected
        var posts = $('.main .history-posts li .checkbox-option-select input[type="checkbox"]');
        
        var selected = [];
        
        // List all posts
        for ( var d = 0; d < posts.length; d++ ) {
            
            if ( posts[d].checked ) {
                selected.push($(posts[d]).attr('data-id'));
            }
            
        }
        
        if ( selected.length < 1 ) {
            
            // Display alert
            Main.popup_fon('sube', words.please_select_a_post, 1500, 2000);
            return;
            
        }
            
        // Create an object with form data
        var data = {
            action: 'planner_add_planification_posts',
            posts: Object.entries(selected),
            planification_id: planification_id
        };

        // Set CSRF
        data[$('.planner-new-post-form').attr('data-csrf')] = $('input[name="' + $('.planner-new-post-form').attr('data-csrf') + '"]').val();

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/planner', 'POST', data, 'planner_add_planification_posts');

        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*******************************
    DEPENDENCIES
    ********************************/
   
    /*
     * Load calendar
     * 
     * @since   0.0.7.5
     */
    $( '#calendar' ).fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        navLinks: true,
        eventLimit: true,
        viewRender: function (view, element) {

            var parsed_date = new Date(Date.parse(view.calendar.currentDate._d));

            $('#calendar').fullCalendar('removeEventSources'); 

            switch(element[0].classList.value) {

                case 'fc-view fc-month-view fc-basic-view':

                    var new_date = new Date(Date.parse(parsed_date.getFullYear() + '-' + (parsed_date.getMonth() + 1) + '-01 00:00:00'));
                    var start = new_date.getTime()/1000;
                    Main.scheduled_events(start,(start+3456000)); 

                    break;

                case 'fc-view fc-basicWeek-view fc-basic-view':
                    var start = parsed_date.getTime()/1000;
                    Main.scheduled_events(start,(start+3456000)); 

                    break;  

                case 'fc-view fc-basicDay-view fc-basic-view':
                    var start = parsed_date.getTime()/1000;
                    Main.scheduled_events(start,(start+86400)); 

                    break;                 

            }
        },
        events: [],
        eventRender: function (event, element, view) {
            var title = element.find('.fc-title');
            title.html(title.text());
            element.attr('data-id',event.ido);
            element.attr('data-meta',event.meta_id);
        }
    });
    
    /*
     * Show emojis icon
     * 
     * @since   0.0.7.5
     */
    $( '.planner-new-post-post-body' ).emojioneArea({
        pickerPosition: 'bottom',
        tonesStyle: 'bullet',
        attributes: {
            spellcheck : true,
            autocomplete   : 'on'
        }
        
    });
    
    // Get posts by search
    Main.planner_all_posts(1);
    
    // Get user's medias
    Main.planner_load_medias(1);
    
    $('#calendar').fullCalendar('removeEventSources'); 
    var parsed_date = new Date();
    var new_date = new Date(Date.parse(parsed_date.getFullYear() + '-' + (parsed_date.getMonth() + 1) + '-01 00:00:00'));
    var start = new_date.getTime()/1000;

    Main.scheduled_events(start,(start+3456000)); 
    
});
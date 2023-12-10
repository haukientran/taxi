var editor_ckedit5 = [];
var selectionItem = '', currentLockBox = null

function addCkeditor(ckeditor_name, auto_content = 0) {
    let parent_name = ".editor_" + ckeditor_name;
    const dnvImage = () => {
        admin_dir = $("meta[name=admin_dir]").attr("content");
        url_media =
            "/" +
            admin_dir +
            "/media?uploads=ckeditor&field_id=" +
            ckeditor_name +
            "&only=image";
        $("#media").find("iframe").attr("src", url_media);
        $("#media").modal("toggle");
    };
    const dnvCKToc = () => {
       $('body').append('<div id="tocList" style="display: none;"></div>');
       let prevH2Item = null;
       let prevH2List = null;
       setTimeout(() => {
           $(parent_name+" .ck-restricted-editing_mode_standard h2, "+ parent_name+" .ck-restricted-editing_mode_standard h3").each(function() {
               let time = new Date().getTime();
               if($(this).text() != '' && $(this).text() != undefined) {
                   if( $(this).is("h2") ){
                       $(this).attr('id', "metoc_"+ time)
                       let li  = "<li class='has_child'><span><i class='fas fa-angle-down'></i></span><a href='#metoc_" + time + "'>" + $(this).text() + "</a></li>";
                       prevH2List = $("<ul></ul>");
                       prevH2Item = $(li);
                       prevH2Item.append(prevH2List);
                       prevH2Item.appendTo("#tocList");
                   } else {
                       $(this).attr('id', "metoc_"+ time)
                       let li = "<li><a href='#metoc_" + time + "'>" + $(this).text() + "</a></li>";
                       if(prevH2List !== null) {
                           prevH2List.append(li);
                       }
                   }
               }
           });
           $('#tocList li.has_child ul').each(function(){
               if($(this).find('li').length <= 0){
                   $(this).remove();
               }
           })
           let toc = $('#tocList').html();
           if(toc != '') {
               let allToc = `<div class="mce-toc"><p class="mce-toc-title"><span style="margin: 4px;">Mục lục</span></p><ul>${toc} </ul></div>`;
               window.editor[ckeditor_name].model.change( writer => {
                   let viewFragment = window.editor[ckeditor_name].data.processor.toView( allToc );
                   let modelFragment = window.editor[ckeditor_name].data.toModel( viewFragment );
                   window.editor[ckeditor_name].model.insertContent( modelFragment, window.editor[ckeditor_name].model.document.selection );
               } );
               html = $( parent_name+' .ck-restricted-editing_mode_standard').html();
               window.editor[ckeditor_name].execute('selectAll');
               window.editor[ckeditor_name].setData(html);
           }
       }, 200);
       setTimeout(() => {
           $('body #tocList').remove();
       }, 240);
    }

    // const dnvHighLight = () => {
    //         let sHtmlSelection = window.editor[ckeditor_name].data.stringify(window.editor[ckeditor_name].model.getSelectedContent(window.editor[ckeditor_name].model.document.selection));
    //         window.editor[ckeditor_name].model.change( writer => {
    //             let html = `<div class="topz-highlight"> ${sHtmlSelection} </div>`
    //             let viewFragment = window.editor[ckeditor_name].data.processor.toView( html );
    //             let modelFragment = window.editor[ckeditor_name].data.toModel( viewFragment );
    //             window.editor[ckeditor_name].model.insertContent( modelFragment, window.editor[ckeditor_name].model.document.selection );
    //         } );
    //     }

    // auto content
    const aiAutoContentWrite = () => {
        let editor = window.editor[ckeditor_name];
        let sHtmlSelection = editor.data.stringify(editor.model.getSelectedContent(editor.model.document.selection));
        let box = $(`#${ckeditor_name}_rewrite_box`);
        box.show();
        box.find(`input.selected-text`).val(sHtmlSelection);

        getContentRewriteFromGPT('write');
        box.find('.rewrite_box__header .title').html(`
            <i class="fa fa-pencil"></i> Viết thêm
        `);
        box.find('.rewrite_box__header__bottom').hide();
    }
    const aiAutoContentRewrite = () => {
        let editor = window.editor[ckeditor_name];
        let sHtmlSelection = editor.data.stringify(editor.model.getSelectedContent(editor.model.document.selection));
        let box = $(`#${ckeditor_name}_rewrite_box`);
        box.show();
        box.find(`input.selected-text`).val(sHtmlSelection);
        box.find('.rewrite_box__header .title').html(`
            <i class="fa fa-paint-brush"></i> Viết lại </span>
        `);

        box.find('.rewrite_box__header__bottom').show();
    }
    const aiAutoContentDescribe = () => {
        alert('Đang phát triển');
    }

    $('body').on('click', `#${ckeditor_name}_rewrite_box .btn-go`, () => {
        let type = $(`#${ckeditor_name}_rewrite_box .type-rewrite`).val();
        getContentRewriteFromGPT(type);
    });

    $('body').on('click', `#${ckeditor_name}_rewrite_box .redo`, () => {
        let type = $(`#${ckeditor_name}_rewrite_box .current-type`).val();
        getContentRewriteFromGPT(type);
    });

    $('body').on('click', `#${ckeditor_name}_rewrite_box .option .copy`, (e) => {
        const copyText = (html) => {
            let text = $(html).text();

            if(navigator.clipboard){
                navigator.clipboard.writeText(text);

            }else{
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(text).select();
                if(document.execCommand('copy')) {
                    // copied
                } else {
                    Clipboard.copy(text);
                }
                $temp.remove();
            }
        }
        let btn = $(e.target);
        let option = btn.closest('.option');
        let html = option.find('.option_body').html().trim();
        copyText(html);
        btn.find('span').text('Đã copy');
    });

    $('body').on('click', `#${ckeditor_name}_rewrite_box .option .insert`, (e) => {
        const insertText = (html, is_replace = 0) => {
            let editor = window.editor[ckeditor_name];

            editor.model.change( writer => {
                let viewFragment = editor.data.processor.toView( html );
                let modelFragment = editor.data.toModel( viewFragment );

                if(is_replace){
                    editor.model.insertContent( modelFragment);
                }else{
                    editor.model.insertContent( modelFragment, editor.model.document.selection.getLastPosition());
                }
            });

            editor.editing.view.focus();
            editor.editing.view.scrollToTheSelection();

        }
        let btn = $(e.target);
        let option = btn.closest('.option');
        let type = option.data('type');
        let html = option.find('.option_body').html().trim();
        insertText(html, type =='write' ? 0 : 1 );
        btn.find('span').text('Đã Chèn');
    });

    let topPositionInput = $(`.editor_${ckeditor_name}`).offset().top;

    jQuery(window).scroll( function( ) {
        let currentTop = jQuery(window).scrollTop();
        let bottomPositionInput = topPositionInput + $(`.editor_${ckeditor_name}`).height();
        let rewriteBox = $(`#${ckeditor_name}_rewrite_box`);
        let rewriteBoxHeight = rewriteBox.height();
        if(currentTop < topPositionInput){
            rewriteBox.css({position:'relative'});
        }else if((currentTop + rewriteBoxHeight) >= bottomPositionInput){
            rewriteBox.css({position:'absolute', 'top': bottomPositionInput - rewriteBoxHeight -topPositionInput, right: 10, left: 10});
        }else{
            rewriteBox.css({position:'absolute', 'top': currentTop - topPositionInput+10, right: 10, left: 10});
        }
    });

    const getContentRewriteFromGPT = (type) => {
        const getContent = () => {
            let content = window.editor[ckeditor_name].getData() || $(`textarea[name="${field_detail}"]`).val();
            let div_content = $('<div></div>').html(content);
            return div_content;
        }
        const getOutline = () => {
            let heading_tags = getContent().find('h1, h2, h3, h4, h5, h6');
            return $.map(heading_tags, (el, i)=>{
                    return el.outerHTML;
            }).join(' ');

        }

        const getClosestHeading = (text) => {
            let div_content = getContent();
            let html_content = div_content.html();
            let index_text = html_content.indexOf(text);
            if(index_text == -1){
                return '';
            }
            let child_html = html_content.substring(0, index_text);
            let parser = new DOMParser();
            let doc = parser.parseFromString(child_html, "text/html");
            let headings = doc.querySelectorAll("h1, h2, h3, h4, h5, h6");
            if(!headings.length){
                return '';
            }

            return headings[headings.length - 1].textContent;
        }

        const renderLoading = (open = 1) => {
            $(`#${ckeditor_name}_rewrite_box .rewrite_result_list .item_loading`).remove();
            if(open){
                let html = `<div class="option item_loading">
                                <svg aria-labelledby="xyrsghc-aria" role="img" width="100%" height="100%" viewBox="0 0 340 84"><title id="xyrsghc-aria">Loading...</title><rect role="presentation" x="0" y="0" width="100%" height="100%" clip-path="url(#xyrsghc-diff)" style="fill: url(&quot;#xyrsghc-animated-diff&quot;);"></rect><defs><clipPath id="xyrsghc-diff"><rect x="0.541992" y="0.28125" width="100%" height="10.7675" fill="#D9D9D9"></rect><rect x="0.541992" y="41.394" width="100%" height="10.7675" fill="#D9D9D9"></rect><rect x="0.541992" y="20.8374" width="90%" height="10.7675" fill="#D9D9D9"></rect><rect x="0.541992" y="61.9502" width="90%" height="10.7675" fill="#D9D9D9"></rect></clipPath><linearGradient id="xyrsghc-animated-diff"><stop offset="0%" stop-color="#f3f3f3" stop-opacity="1"><animate attributeName="offset" values="-2; -2; 1" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite"></animate></stop><stop offset="50%" stop-color="#ecebeb" stop-opacity="1"><animate attributeName="offset" values="-1; -1; 2" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite"></animate></stop><stop offset="100%" stop-color="#f3f3f3" stop-opacity="1"><animate attributeName="offset" values="0; 0; 3" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite"></animate></stop></linearGradient></defs></svg>
                            </div>
                            <div class="option item_loading">
                                <svg aria-labelledby="xyrsghc-aria" role="img" width="100%" height="100%" viewBox="0 0 340 84"><title id="xyrsghc-aria">Loading...</title><rect role="presentation" x="0" y="0" width="100%" height="100%" clip-path="url(#xyrsghc-diff)" style="fill: url(&quot;#xyrsghc-animated-diff&quot;);"></rect><defs><clipPath id="xyrsghc-diff"><rect x="0.541992" y="0.28125" width="100%" height="10.7675" fill="#D9D9D9"></rect><rect x="0.541992" y="41.394" width="100%" height="10.7675" fill="#D9D9D9"></rect><rect x="0.541992" y="20.8374" width="90%" height="10.7675" fill="#D9D9D9"></rect><rect x="0.541992" y="61.9502" width="90%" height="10.7675" fill="#D9D9D9"></rect></clipPath><linearGradient id="xyrsghc-animated-diff"><stop offset="0%" stop-color="#f3f3f3" stop-opacity="1"><animate attributeName="offset" values="-2; -2; 1" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite"></animate></stop><stop offset="50%" stop-color="#ecebeb" stop-opacity="1"><animate attributeName="offset" values="-1; -1; 2" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite"></animate></stop><stop offset="100%" stop-color="#f3f3f3" stop-opacity="1"><animate attributeName="offset" values="0; 0; 3" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite"></animate></stop></linearGradient></defs></svg>
                            </div>`;
                $(`#${ckeditor_name}_rewrite_box .rewrite_result_list`).prepend(html);
            }


        }


        const renderError = (message) => {
            let html = `<div class="option">
                            <div class="option_header">
                                <span>Lỗi</span>
                            </div>
                            <div class="option_body">
                                <p class="error">${message}</p>
                            </div>
                        </div>`;
            $(`#${ckeditor_name}_rewrite_box .rewrite_result_list`).prepend(html);
        }


        const renderOption = (messages, type) => {
            let html = '';
            messages.forEach((ans, i) => {
                let title = `Option ${i+1}`;
                ans = ans.trim().replace("\r", "").replace("\n\n", "<br />").replace("\n", "<br />");

                html += `<div class="option" data-type="${type}">
                            <div class="option_header">
                                <span>${title}</span>
                            </div>
                            <div class="option_body">
                                ${ans}
                            </div>
                            <div class="option_footer">
                                <div class="option_footer__tool insert">
                                    <i class="fa fa-arrow-circle-o-left"></i> Insert
                                </div>
                                <div class="option_footer__tool copy">
                                    <i class="fa fa-copy"></i> Copy
                                </div>
                            </div>
                        </div>`;
            });

            $(`#${ckeditor_name}_rewrite_box .rewrite_result_list`).prepend(html);
        }


        let rewriteBox = $(`#${ckeditor_name}_rewrite_box`);
        rewriteBox.find('input.current-type').val(type);
        let text = rewriteBox.find('input.selected-text').val();
        let heading = getClosestHeading(text);
        let field_title = rewriteBox.data('field_title');
        let title = $(`input[name="${field_title}"`).val().trim();
        let outline = getOutline();

        // Run
        console.log('Bắt đầu viết bài chatgpt');
        renderLoading();

        rewriteBox.find('.rewrite_result_list').animate({ scrollTop: 0 }, 'slow');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                type, text, title, heading, outline
            },

            url: '/admin/ajax/getRewriteContentFromChatGPT',

            success: function (result) {
                if(result.success == 1){
                    data = result.data;
                    ans = data.answer;
                    renderOption(ans, type);

                }else{
                    renderError(result.message);
                }
                renderLoading(false);
                rewriteBox.find('.rewrite_box__header__bottom').hide();

                console.log('Hoàn tất viết bài chatgpt');

            },
            error: function (error) {
                rewriteBox.find('.rewrite_box__header__bottom').hide();
                renderError(error, 1);
                renderLoading(false);
                console.log('Hoàn tất viết bài chatgpt');
            },
            // async: false
        });

    }
    let cfg = {
        dnvImage,
        dnvCKToc,
        aiAutoContentWrite: aiAutoContentWrite,
        aiAutoContentRewrite: aiAutoContentRewrite,
        aiAutoContentDescribe: aiAutoContentDescribe,
        simpleUpload: {
            uploadUrl: '/admin/media/upload-from-editor',
            withCredentials: false,
            types: ['png', 'jpeg', 'jpg', 'svg', 'gif']
        }
    }
    if(auto_content){
        cfg.toolbar =  {
                'items' : [
                    ...ClassicEditor.defaultConfig.toolbar.items,
                    '|',
                    'auto_content_write',
                    'auto_content_rewrite',
                ],
                shouldNotGroupWhenFull: true,
            };

    }
    ClassicEditor.create(document.querySelector("#" + ckeditor_name), cfg)
    .then((editor) => {
        editor_ckedit5[ckeditor_name] = editor;
        window.editor = editor_ckedit5;
        let wordCountPlugin = editor.plugins.get("WordCount");
        let wordCountWrapper = document.getElementById(
            ckeditor_name + "_count"
        );
        wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);
    })
    .catch((error) => {
        console.warn("Init ckeditor error");
        console.error(error);
    });

}
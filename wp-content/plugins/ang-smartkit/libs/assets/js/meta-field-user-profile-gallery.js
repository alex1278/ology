jQuery(function ($) {
    'use strict';

    function AltImageUpdate(user_id, thumb_id) {
        var data = {
            'action': 'setuser-multiple-thumbnails',
            'thumbnail_id': thumb_id,
            'nonce': ang_user_gallery.nonce,
            'user_id': user_id
        };

        $.ajax({
            url: ajaxurl, // handler
            data: data, // data
            type: 'POST',
            cache: false,
            // handle error
//            error: function (xhr, status, error) {
//                debugger;
//                alert(xhr.readyState);
//                alert(xhr.statusText);
//                alert(xhr.status);
//                alert(xhr.responseText);
//                alert(status);
//                alert(error);
//            },
            // succesful server response
            success: function (data) {
                if (data) {
                    $('.ang-user-gallery-container').find('.ang-inside-gallery').empty().append(data.data); // insert new images
                } else {
                    $('.ang-user-gallery-container').find('.ang-inside-gallery').append(data.data); //if something was wrong
                    alert('no data');
                }
            }
        });
    }

    $('#set-user-thumbnails').on('click', function () {
        var inp = $('#set-user-thumbnails').prev();

        // Create WP media gallery window
        //    var mediaFrame = wp.media({ 
        //        title: 'Upload Images',
        //        // mutiple: true if you want to upload multiple files at once
        //        multiple: 'add'
        //    });
        var mediaFrame = wp.media({
            title: ang_user_gallery.l10n.uploaderTitle, // media uploader title
            button: {text: ang_user_gallery.l10n.uploaderButton}, // media uploader submit button text
            multiple: 'add' // multiple images: true or false, multiple without holding Ctrl: 'add'
        });

        // Open WP media gallery window
        mediaFrame.on('open', function () {
            var selection = mediaFrame.state().get('selection');
            if (inp.val().length > 0) {
                var ids = inp.val().split(',');
                console.log(ids);
                ids.forEach(function (id) {
                    var attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add(attachment ? [attachment] : []);
                });
            }
        });

        // On select images in WP media gallery window
        mediaFrame.on('select', function (e) {
            var selection = mediaFrame.state().get('selection');
            var imagesIDs = [];
            console.log(imagesIDs)
            selection.map(function (attachment) {
                // Get selected images IDs
                attachment = attachment.toJSON();
                for (var k in attachment) {
                    if (k == "id") {
                        imagesIDs.push(attachment[k]);
                    }
                }
            });
            var user_id = $('#user_id').val();
            AltImageUpdate(user_id, imagesIDs);
            inp.val(imagesIDs);
        });
        ///
        mediaFrame.on('select', function () {
            var attachments = [];
            mediaFrame.state().get('selection').forEach(function (i) {
                attachments.push(i.id);
            });
        });

        ///
        mediaFrame.open();
        return false;
    });

    $('.ang-user-gallery-container')
            .on('click', '.ang-click-to-remove', function (e) {
                var user_id = $('#user_id').val();
                var imgId = $(this).parent().attr('data-ang-image-id');
                var $this = $('#media-uploader');
                var mediaVals = $this.val();
                if (mediaVals.length) {
                    var splitVals = mediaVals.split(',');

                    splitVals.splice($.inArray(imgId, splitVals), 1);

                    AltImageUpdate(user_id, splitVals);
                    var newVal = splitVals.join(',');
                    $this.val(newVal);
                    $(this).parent().fadeOut(500, function () {
                        $(this).remove();
                    });
                } else {
                    AltImageUpdate(user_id, -1);
                }
                e.preventDefault();
            });
    $('.ang-user-gallery-container')
            .on('click', '#remove-post-multiple-thumbnails', function (e) {
                var user_id = $('#user_id').val();
                $('.ang-user-gallery-container').find('.ang-inside-gallery').children().fadeOut(500, function () {
                    $(this).remove();
                    $('#media-uploader').val('');
                });
                e.preventDefault();
                e.stopPropagation();
                AltImageUpdate(user_id, -1);
            });

});
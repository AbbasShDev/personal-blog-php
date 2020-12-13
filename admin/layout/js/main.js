$(document).ready(function () {

    let ckeEditor = ClassicEditor
        .create( document.querySelector( '#post-content' ),{
            language: 'ar'
        } )
        .catch( error => {
            console.error( error );
        } );

    //dashboard
    $('.toggle-info').click(function () {
        $(this).children('i').toggleClass(' fa-plus').parents('.card-header').next('.latest-info').slideToggle(350);
        // $(this).children('i').toggleClass(' fa-plus');
    })

    //showing notification message
    $('.notify-message').each(function () {

        $(this).animate({
                left:'10px'
            },1000,
            function () {
                $(this).delay(3000).fadeOut();
            })
    })

    //edit post button
    $('.edit-post-btn').on('click', function (){
        $.ajax({
            method:'POST',
            url:'edit_process',
            dataType:'json',
            data:{post_id: $(this).data('post_id')},
            success:function (data){
                $('#edit-post-modal #post-id').val(data["id"])
                $('#edit-post-modal #post-title').val(data["post_title"])
                $('#edit-post-modal #post-cat').val(data["post_category"])
                ckeEditor.then( editor => { editor.setData(data["post_content"]);})
            },
            error:function (data){
                console.log(data);
            }
        })
    })

    //edit category button
    $('.edit-category-btn').on('click', function (){
        $.ajax({
            method:'POST',
            url:'edit_process',
            dataType:'json',
            data:{category_id: $(this).data('category_id')},
            success:function (data){
                $('#edit-category-modal #category-id').val(data["id"])
                $('#edit-category-modal #category-name').val(data["category_name"])

            },
            error:function (data){
                console.log(data);
            }
        })
    })

    $('.edit-category-form').on('submit', function (e){
        e.preventDefault();
        console.log()

        $.ajax({
            method:'POST',
            url:'edit_process',
            data:$('.edit-category-form').serialize(),
            success: function (data) {
                if (data == 'updated successfully'){
                    location.href = '';
                }else {
                    $('#edit-category-modal .edit-category-errors').html('');
                    $('#edit-category-modal .edit-category-errors').html(data);
                }
            }
        })
    })

});
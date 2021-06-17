$(document).on('click', '.lineAside', function(){
    let p = $(this).find('p.loginName').text();
    console.log(p);
    location.href = "http://localhost/blog/blog.php?id=" + p
    return false;
});

$(document).on('click', '#b2', function(){
    let r = $(this).find('p.numPost').text();
    let t = $(this).find('p.textPost').text();
    let i = $(this).find('p.picPost').text();
    $.ajax({
        type: "post",
        url: "serv.php",
        datatype: text,
        data: {num: r,message: t, img: i},
        success:function(){
            $('.modal2')[0].style.display = "block";
            $('.fullback2')[0].style.display = "block";
            var text = $('#text2');
            var img = $('#imgPost');
            text.text(t);
            img.attr('src', i);
            $('#mostId').text(r);
        }
    })
});

$(".close2")[0].onclick = function(){
    $(".fullback2")[0].style.display = "none";
    $(".modal2")[0].style.display = "none";
}

$(document).ready(function(){
    var file
    $('#mesFile').on('change', function(){
        file = this.files;
        console.log(file);
    })

    $('#changePost').click(function(e){
        e.preventDefault();
        var text = $('#text2').val();
        var id = $('#mostId').text();
        var data = new FormData();
        $.each(file, function( key, value){
            data.append( key, value);
        })
        data.append('file_post', 1)
        data.append('textVal', text);
        data.append('id', id);
        $.ajax({
            type: "post",
            url: "serv.php",
            datatype: "text",
            data: data,
            processData: false,
            contentType: false,
            success: function(){
                $('.modal2')[0].style.display = "none";
                $('.fullback2')[0].style.display = "none";
                location.reload();
            }
        })
    }
)})

$(document).on('click', '#b3', function(){
    var id_post = $(this).find($('.numpost')).text();
    $.ajax({
        type: 'post',
        url: 'serv.php',
        datatype: 'text',
        data: 'id_p=' + id_post,
        success: function(){
            location.reload();
        }
    })
})

$(document).on('click', '#btnSub', function(){
    var user = $('#user').text();
    var curBlog = $('#curBlog').text();
    if (this.classList.contains('btnSub')){
    $.ajax({
        type: 'post',
        datatype: 'text',
        url: 'serv.php',
        data: {user: user, blog: curBlog},
        success: function(){
            $('#btnSub').removeClass('btnSub');
            $('#btnSub').addClass('btnFol');
            $('#btnP').text('Отписаться');
            let txt = Number($('#fols').text());
            txt = txt + 1;
            $('#fols').text(txt)
        }
    })
    } else 
    if(this.classList.contains('btnFol')){
        $.ajax({
            type: 'post',
            datatype: 'text',
            url: 'serv.php',
            data: {userO: user, blogO: curBlog},
            success: function(){
                $('#btnSub').removeClass('btnFol');
                $('#btnSub').addClass('btnSub');
                $('#btnP').text('Подписаться');
                let txt = Number($('#fols').text());
            txt = txt - 1;
            $('#fols').text(txt)
            }
        })
    }
})

$(document).on('click', '.like', function(){
    console.log('true');
    let r = $(this).find('p.numPostLike').text();
    let u = $(this).find('p.userPost').text();
    if (this.classList.contains('b1')){
    $.ajax({
        type: "post",
        url: "serv.php",
        datatype: text,
        data: {numPost: r, userPost: u},
        success: function(){
            location.reload();
        }
    })}
    else
    if (this.classList.contains('b1active')){
    console.log(r,u);
    $.ajax({
        type: "post",
        url: "serv.php",
        datatype: text,
        data: {numPostO: r, userPostO: u},
        success: function(){
            location.reload();
        }
    })}
});

$(document).ready(function(){
    var ar = $('.like').length;
    console.log(ar);
    for (var i = 0; i < ar;i++) {
        $('.like')
    }
})

$(document).on('click', '.liked', function(){
    var p = $(this).find('p.ld').text();
    $.ajax({
        url: 'serv.php',
        type: 'post',
        datatype: 'text',
        data: "p=" + p,
        success: function(html){
            var obj1 = $('.fullback3')[0];
            var obj2 = $('.modal3')[0];
            var obj3 = $('#content');
            obj1.style.display = 'block';
            obj2.style.display = 'block';
            obj3.append(html);
        }
    })
})

$(".close3")[0].onclick = function(){
    $(".fullback3")[0].style.display = "none";
    $(".modal3")[0].style.display = "none";
    $("#removeto").remove();
}
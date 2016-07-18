/**
 * Created by maryatimth on 5/3/2016.
 */
function apus(e) {
    alert('tes');
    $(e).closest('li').remove();
    var remarraytest = "Andorra";
    arraytest = $.grep(arraytest,function (value) {
        return value != remarraytest;
    });
    alert(arraytest);
}

// $('a.hapus').click(function () {
//     alert('tes');
//     $(this).closest('li').remove();
// });
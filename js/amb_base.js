function addSnackbar(string, timeout = 3000) {
  snackbarContainer = document.querySelector('#toast');
  var data = { message: string, timeout: timeout };
  snackbarContainer.MaterialSnackbar.showSnackbar(data);
} 
if ($('.cpy-btn').length) {
    new Clipboard('.cpy-btn');
}

$( function() {
  if ($('#full-img').length && $('#crop').length && $('#crop-btn').length) {
    var full_img_top = $('#full-img').position().top;
    var full_img_left = $('#full-img').position().left;

    $('#crop').css("top", full_img_top + 50).css("left", full_img_left + 50);
    $("#crop").draggable({containment: "parent"}).resizable({
      containment: "parent",
      minWidth: 100,
      minheight: 100,
      aspectRatio: 1 / 1
    });

    $('#crop-btn').click(
      function() {
        var img_pos_x = $('#full-img img').position().left;
        var img_pos_y = $('#full-img img').position().top;

        var crop_pos_x = $('#crop').position().left;
        var crop_pos_y = $('#crop').position().top;

        var img_width = $('#full-img img').width();
        var img_height = $('#full-img img').height();

        var crop_width = $('#crop').width();
        var crop_height = $('#crop').height();

        var crop_img_x = crop_pos_x - img_pos_x;
        var crop_img_y = crop_pos_y - img_pos_y;

        var file = $('#full-img img').attr("data-img-file");
        var aid = $('#full-img img').attr("data-aid");

        $.post("/profile/crop/process.php", {
          file: file,
          pos_x: crop_img_x,
          pos_y: crop_img_y, 
          width: crop_width,
          height: crop_height,
          img_width: img_width,
          img_height: img_height,
          aid: aid
        }, function(data) {
          document.location = '/profile/?updated=1';
        });

      }
    );
  }
});
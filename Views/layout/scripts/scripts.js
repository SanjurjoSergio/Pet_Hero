var inputs = $(".inputs");

var select1 = $("#select1");
var select2 = $("#select2");

inputs.change(() => {
  if ($("#input1").is(":checked")) {
    select1.show();
    select2.hide();
  } else {
    select2.show();
    select1.hide();
  }
});
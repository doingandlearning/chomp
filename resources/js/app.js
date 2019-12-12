function trigger_attendance_update(element) {
  if (element[0].classList.contains("family_click")) {
    return;
  }

  let checkbox = $(this);
  checkbox.css("display", "none");
  const session_id = element.attr("session_id");
  const person_id = element.attr("person_id");
  let child = false;
  let adult = false;

  if (element[0].classList.contains("adult_click")) {
    adult = true;
  } else {
    child = true;
  }

  $.ajax({
    url: "/register",
    type: "POST",
    dataType: "json", // type of response data
    timeout: 1500, // timeout milliseconds
    data: {
      session_id: session_id,
      person_id: person_id,
      child: child,
      adult: adult,
      _token: $("#token").val()
    },
    success: function(data, status, xhr) {
      // success callback function
      checkbox.css("display", "unset");
    },
    error: function(jqXhr, textStatus, errorMessage) {
      // error callback
      alert("Error: " + errorMessage);
    }
  });
}

function update_adult_attendance(element) {
  const family_id = $(this).attr("family_id");
}

$(document).ready(function() {
  $(".family_click").click(function() {
    $(this).css("visibility", "hidden");
    if ($(this).prop("checked")) {
      $(this)
        .closest("fieldset")
        .find("input")
        .prop("checked", true)
        .each(function(e) {
          trigger_attendance_update($(this));
        });
    } else {
      $(this)
        .closest("fieldset")
        .find("input")
        .prop("checked", false)
        .each(function(e) {
          trigger_attendance_update($(this));
        });
    }
  });

  $(".adult_click").change(function() {
    $(this)
      .closest("fieldset")
      .find(".family_click")
      .css("visibility", "hidden");
    trigger_attendance_update($(this));
  });

  $(".child_click").click(function() {
    $(this)
      .closest("fieldset")
      .find(".family_click")
      .css("visibility", "hidden");
    trigger_attendance_update($(this));
  });
});

$(document).ready(function() {
  var postURL = "<?php echo url('addmore'); ?>";
  var i = 10;
  var j = 10;

  function childHTML(i) {
    return (
      '<div id="divchild' +
      i +
      '"class="bg-grey-lighter shadow-md rounded px-8 pt-6 pb-8 mb-4">\n' +
      '          <div class="mb-4">\n' +
      '          <label class="text-gray-700" for="child[' +
      i +
      '][name]">Child name</label>\n' +
      '      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="child[' +
      i +
      '][name]" name="child[' +
      i +
      '][name]">\n' +
      "          </div>\n" +
      '          <div class="mb-4">\n' +
      '          <label class="text-gray-700" for="child[' +
      i +
      '][birthyear]">Year of birth <span class="text-red-600">(we don\'t need a more accurate birthday, just the year)</span></label>\n' +
      '      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="child[' +
      i +
      '][birthyear]" name="child[' +
      i +
      '][birthyear]">\n' +
      "          </div>\n" +
      '          <div class="mb-4">\n' +
      '          <label class="text-gray-700" for="child[' +
      i +
      '][special_requirements]">Additional Information (food, health, anything you think is important)</label>\n' +
      '      <textarea class="form-textarea mt-1 block w-full" rows="3" value="" class="form-control" id="child[' +
      i +
      '][special_requirements]" name="child[' +
      i +
      '][special_requirements]"></textarea>' +
      "          </div>\n" +
      '  <button type="button" class="text-red-400 btn_remove" id="child' +
      i +
      '">Remove Child</button>' +
      "          </div>"
    );
  }

  function adultHTML(j) {
    return (
      '<div id="divadult' +
      j +
      '" class="bg-grey-lighter shadow-md rounded px-8 pt-6 pb-8 mb-4">\n' +
      '          <div class="mb-4">\n' +
      '          <label class="text-gray-700" for="adult[' +
      j +
      '][name]">Adult name</label>\n' +
      '      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="adult[' +
      j +
      '][name]" name="adult[' +
      j +
      '][name]">\n' +
      "          </div>\n" +
      '  <button type="button" class="text-red-400 btn_remove" id="adult' +
      j +
      '">Remove Adult</button>' +
      "          </div>"
    );
  }

  $("#addchild").click(function() {
    $("#children").append(childHTML(i));
    i++;
  });

  $("#addadult").click(function() {
    $("#extraadult").append(adultHTML(j));
    j++;
  });

  $(document).on("click", ".btn_remove", function() {
    var button_id = $(this).attr("id");
    $("#div" + button_id + "").remove();
  });
});

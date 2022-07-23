
function change_type() {
    $("#2").empty();
    $("#3").empty();
    $("#4").empty();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax_receipt.php?type=" + document.getElementById("type").value, false);
    xmlhttp.send(null);
    document.getElementById("1").innerHTML = xmlhttp.responseText;
    if(document.getElementById("type").value==0)
    {
    document.getElementById("2").innerHTML = ' <div class="search-box"><input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required/><div class="result"></div></div>';

    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';
    }
    if(document.getElementById("type").value==1 || document.getElementById("type").value==2 || document.getElementById("type").value==3 )
    {
        document.getElementById("2").innerHTML = ' <div class="search-box"><input class="form-control" name="input" type="text" autocomplete="off" placeholder="Enter Value..." required/><div class="result"></div></div>';

    document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

    }
    if(document.getElementById("type").value==4)
    {
        document.getElementById("2").innerHTML = '<input name="receipt_id" placeholder="Enter Receipt Number" class="form-control">';

        document.getElementById("3").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

    }
 
    $('.search-box input[type="text"]').on("keyup input", function() {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("search_name.php", {
                term: inputVal
            }).done(function(data) {
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function() {
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });



}
function change_br() {

    $("#3").empty();
    $("#4").empty();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax_receipt.php?br=" + document.getElementById("br").value, false);
    xmlhttp.send(null);
    document.getElementById("2").innerHTML = xmlhttp.responseText;
    if (document.getElementById("br").value == 0) {
        document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';
    }
    else
    {
        document.getElementById("3").innerHTML = ' <input name="receipt_id" placeholder="Enter Receipt Number" class="form-control">';
        

        document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

    }
  
    
            $('.search-box input[type="text"]').on("keyup input", function() {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("search_name.php", {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
      




}

function change_br123() {

    $("#3").empty();
    $("#4").empty();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax_receipt.php?br123=" + document.getElementById("br123").value, false);
    xmlhttp.send(null);
    document.getElementById("2").innerHTML = xmlhttp.responseText;
    if (document.getElementById("br123").value == 0) {
        document.getElementById("4").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';
    }
    else
    {
       

        document.getElementById("3").innerHTML = '<button name="submit" class="btn btn-primary" value="submit">Submit</button>';

    }
  
    
            $('.search-box input[type="text"]').on("keyup input", function() {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("search_name.php", {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
      




}


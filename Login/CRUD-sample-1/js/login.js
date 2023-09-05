        //login script//
        var modal = document.getElementById("id01");
        var btn = document.getElementById("but");
        var span = document.getElementById("close");
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }

        //register script//
        var modal_re = document.getElementById("id02");
        var btn_re = document.getElementById("but_re");
        var spa = document.getElementById("close-re");
        btn_re.onclick = function() {
            modal_re.style.display = "block"
        }
        spa.onclick = function() {
            modal_re.style.display = "none";
        }
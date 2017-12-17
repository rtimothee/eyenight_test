(function () {
    var more_event_details = document.getElementsByClassName("more_event_details");

    for (var i = 0; i < more_event_details.length; i++) {
        more_event_details[i].addEventListener('click', function () {
            var url = this.getAttribute("data-url");
            var id = this.getAttribute("data-id");
            var button = this;
            var event_content = document.getElementById("content_" + id);

            if ("undefined" !== typeof button.childNodes[1] && "expand_more" === button.childNodes[1].innerHTML) {
                button.childNodes[1].innerHTML = "expand_less";

                if ("" === document.getElementById("content_" + id).innerHTML) {
                    event_content.innerHTML = "<div class='loader_container'><div class='loader'></div></div>";

                    var xhttp = new XMLHttpRequest();

                    xhttp.onreadystatechange = function () {
                        if (4 === this.readyState && 200 === this.status) {
                            event_content.innerHTML = this.responseText;
                        }
                    };

                    xhttp.open("GET", url, true);
                    xhttp.send();
                }
                event_content.className = "event_content show";

            } else if("undefined" !== typeof button.childNodes[1] && "expand_less" === button.childNodes[1].innerHTML){
                button.childNodes[1].innerHTML = "expand_more";
                event_content.className = "event_content";
            }


        }, false);
    }
})();
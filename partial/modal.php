<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="#" alt="#" id="modalimg">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p id="modalcontent"></p>
                <a  id="modallink" href="#" class="btn btn-primary">Show more</a>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    const settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://matchilling-chuck-norris-jokes-v1.p.rapidapi.com/jokes/random",
        "method": "GET",
        "headers": {
            "accept": "application/json",
            "x-rapidapi-key": "ab87421a43msh7648e08e514b943p1d41c7jsn1d4bbcb507aa",
            "x-rapidapi-host": "matchilling-chuck-norris-jokes-v1.p.rapidapi.com"
        }
    };

    $.ajax(settings).done(function (response) {
        $( ".modallink" ).click(function() {

            $('#modallink').attr("href",response.url);
            $('#modalcontent').html(response.value);
            $('#modalimg').attr("src",response.icon_url);

        });
    });


</script>
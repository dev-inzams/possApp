$(document).ready(function() {
    // Open modal
    function openModal(){
        document.getElementById('customModal').style.display = 'block';
     }

    //  close modal
     function closeModal(){
        document.getElementById('customModal').style.display = 'none';
     }
    // Close modal on outside click
    $(window).click(function(event) {
        if (event.target.id === "customModal") {
            $("#customModal").css("display", "none");
        }
    });
});

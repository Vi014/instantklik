function deleteLinkedProfile(NalogID)
{
    $.ajax
    (
        {
            type: 'POST',
            url: 'deleteLinkedProfile.php',
            data: "NalogID=" + NalogID,
            success: function(data) 
            {
                window.location = 'editProfile.php';
            },
            error: function() 
            {
                alert("Došlo je do greške.");
            }
        }
    );
}
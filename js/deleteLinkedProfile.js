function deleteLinkedProfile(NalogID, ROOT_PATH, ROOT_URL)
{
    $.ajax
    (
        {
            type: 'POST',
            url: ROOT_PATH + 'func/queries/deleteLinkedProfile.php',
            data: "NalogID=" + NalogID,
            success: function(data) 
            {
                window.location = ROOT_URL + 'editProfile.php';
            },
            error: function() 
            {
                alert("Došlo je do greške.");
            }
        }
    );
}
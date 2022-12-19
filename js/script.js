function changeLanguage(langName, ROOT_PATH, ROOT_URL, errorMessage)
{
    $.ajax
    (
        {
            type: 'POST',
            url: ROOT_URL + '/func/changeLanguage.php',
            data: "langName=" + langName,
            success: function(data) 
            {
                location.reload(true);
            },
            error: function() 
            {
                alert(errorMessage);
            }
        }
    );
}

function deleteLinkedProfile(NalogID, ROOT_PATH, ROOT_URL, errorMessage)
{
    $.ajax
    (
        {
            type: 'POST',
            url: ROOT_URL + '/func/queries/deleteLinkedProfile.php',
            data: "NalogID=" + NalogID,
            success: function(data) 
            {
                window.location = ROOT_URL + '/editProfile.php';
            },
            error: function() 
            {
                alert(errorMessage);
            }
        }
    );
}
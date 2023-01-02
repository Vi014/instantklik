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

function deleteLinkedProfile(accountID, ROOT_PATH, ROOT_URL, errorMessage)
{
    $.ajax
    (
        {
            type: 'POST',
            url: ROOT_URL + '/func/queries/deleteLinkedProfile.php',
            data: "accountID=" + accountID,
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

function checkSize(fileSize, sizeError, extError)
{
    var uploadBtn = $('#uploadBtn');
    
    if(fileSize>4)
    {
        alert(sizeError);
        uploadBtn.val('');
        return;
    }
    
    var fileName = uploadBtn.val();
    var extIndex = fileName.lastIndexOf('.') + 1;
    var fileExt  = fileName.substr(extIndex, fileName.length).toLowerCase();

    if(fileExt != 'png' && fileExt != 'gif' && fileExt != 'jpg' && fileExt != 'jpeg' && fileExt != 'jfif' && fileExt != 'pjpeg' && fileExt != 'pjp')
    {
        alert(extError);
        uploadBtn.val('');
    }
}

function foo()
{
    alert('a');
}
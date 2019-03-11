let noContactsTemplate = '<tr><td colspan="7" class="alert alert-danger text-center"><strong>no results</strong></td></tr>',
    contactTemplate = '<tr data-id="{id}">\n' +
        '                <td class="d-none d-lg-table-cell">{id}</td>\n' +
        '                <td>{name}</td>\n' +
        '                <td class="d-none d-lg-table-cell">{username}</td>\n' +
        '                <td class="d-none d-lg-table-cell">{email}</td>\n' +
        '                <td>{phone}</td>\n' +
        '                <td><a href="user/update/id/{id}"><button class="btn btn-primary"><i class="fas fa-pen-square"></i></button></a></td>\n' +
        '                <td><button class="btn btn-danger delete-user-btn"><i class="fas fa-times-circle"></i></button></td>\n' +
        '            </tr>',
    $resultsContainer = null,
    xhr = null;

$(document).on('ready',function(){
    $resultsContainer = $('#results-container table.table tbody');

    //fetch users on page load
    fetchContacts('');

    //fetch users on each keyup - can be done with change but change needs the input to get out of focus to trigger
    //notice that on key up can be problematic if you have a lot of results due to long process and render time
    $('#contact-search-input').on('keyup',function () {
        fetchContacts($(this).val());
    });

    //delete users button event bind
    $(document).on('click','.delete-user-btn',function(){
        if(! confirm('Are you sure you want to delete this contact?'))
            return;
        if(xhr !== null)
        {
            xhr.abort();
            xhr = null;
        }
        let $row = $(this).closest('tr');
        //send delete request to server
        xhr = $.ajax({
            url: 'user/delete',
            dataType: 'JSON',
            data : 'id=' + $row.data('id'),
            success: function(data)
            {
                if(data.success)
                {
                    //if delete is successful remove the row
                    $row.remove();
                }
            },
            complete: function () {
                xhr = null;
            }
        });
    });
});

function fetchContacts(query){
    if(xhr !== null)
    {
        xhr.abort();
        xhr = null;
    }
    $resultsContainer.html('');

    //send request with the query to the server
    xhr = $.ajax({
        url: 'site/fetchUsers',
        dataType: 'JSON',
        data : 'query=' + query,
        success: function(data)
        {
            if(data.success)
            {
                //populate the results container with the response data from server
                $.each(data.contacts, function(index,contact){
                    $resultsContainer.append(replaceTemplate(contactTemplate,contact));
                });
            }
            else
            {
                $resultsContainer.html(noContactsTemplate);
            }
        },
        complete: function () {
            xhr = null;
        }
    });
}

//utility function for template replacement
function replaceTemplate(template, data) {
    const pattern = /\{(.*?)\}/g; // {property}
    return template.replace(pattern, (match, token) => data[token]);
}

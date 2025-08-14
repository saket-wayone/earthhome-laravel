function getbalanceamount(value) {
    $.ajax({
        method: 'POST',
        url: window.origin + '/admin/projects/getbalance',
        data: {
            id: value,
            _token: document.querySelector('input[name="_token"]').value

        },
        success: function (res) {
            if (res.code == 401) {
                $('.appendView').html(res.message);  // Display the error message
            } else if (res.code == 200) {
                if (res.data.balance > 0) {
                    $('#remaningamount').attr('required', true);
                    $('#advanceRecepit').attr('required', true);
                    $('#lastamount').val(res.data.balance);
                    $('#lead_id2').val(res.data.lead_id);
                    $('#paidamount2').attr('max', res.data.balance);
                    $('#balanceamount').html(`₹ ${res.data.balance}`);  // Append the HTML returned from the server
                    $('#overallprojectCost').html(`Overall Project Payment : ₹ ${res.data.overallprojectCost}`); 
                    $('#balanceamountdiv').show();
                } else {
                    $('#balanceamountdiv').show();
                    $('#remaningamount').attr('required', false);
                    $('#advanceRecepit').attr('required', false);

                    $('#balanceamount').html(`No Remaining Payment`);  // Append the HTML returned from the server
                }
                $('.tabledata').html(res.data.table);
            } else {
                alert('Unexpected response code: ' + res.code);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error: ' + error);  // Handle AJAX errors
            alert('An error occurred while processing the request.');
        }
    });
}


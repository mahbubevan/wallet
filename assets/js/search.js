$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    $("#search_input").keyup(function(){
        var search_data = document.getElementById('search_input').value;
        console.log(search_data);
        $.ajax({
            url: "/wallet/admin/search",
            type:'post',
            data: {
              search:search_data,
            },
            success: function( result ) {
                console.log(result);
                // var tablePagination = {
                //     current_page:result.data.current_page,
                //     first_page_url:result.data.first_page_url,
                //     from: result.data.from,
                //     last_page: result.data.last_page,
                //     last_page_url: result.data.last_page_url,
                //     next_page_url: result.data.next_page_url,
                //     path: result.data.path,
                //     per_page: result.data.per_page,
                //     prev_page_url:result.data.prev_page_url,
                //     to: result.data.to,
                //     total:result.data.total
                // }
                var tableData = result.data.map(function (item){
                    // console.log(item.trax_id)
                  return `<tr><th scope="row">${item.trax_id}
                            <td><a class="text-primary" href="profile/${item.user.id}">${item.user_name}</a>
                            </td>
                            <td>
                                ${item.status==0 ? 
                                    `<div class="row">
                                        <div class="col-md-8">
                                        <span class="text-danger">${item.amount} (${result.currency})</span>
                                        </div>
                                        <div class="col-md-4">
                                    <span class="ml-3 text-danger"><i class="fas fa-arrow-right"></i></span> 
                                </div>
                                    </div>` : `<div class="row">
                                    <div class="col-md-8">
                                    <span class="text-success">${item.amount} (${result.currency})</span>
                                    </div>
                                    <div class="col-md-4">
                                <span class="ml-3 text-success"><i class="fas fa-arrow-left"></i></span> 
                            </div>
                                </div>`}
                            </td>
                            <td>${item.charge} (${result.currency})</td>
                    <td>${item.current_balance} (${result.currency}) </td>
                    <td> ${item.remarks} </td>
                    <td>
                        ${item.status==0? `<span class="text-danger">DEBITED</span>` : `<span class="text-success">CREDITED</span>`}
                    </td>
                    <td>${item.created_at}</td>
                        </th></tr>`
             })
            //  console.log(tableData)
             if(result.length ===0){
                $("#table-data").text("<tr><td>No Data</td></tr>")
             }
             $("#table-data").html(tableData)
             var count = `Result Found: ${result.count}`;
            //  var html = `<a href="${tablePagination.prev_page_url}" class="btn btn-sm btn-outline-success"> Previous </a><a href="${tablePagination.next_page_url}" class="ml-2 btn btn-sm btn-outline-success"> Next </a>`
             console.log(result.count)
             $("#total_count").html(count)

            }
          });

    })
})
jQuery("document").ready(function () {
  jQuery("#jobseekerlist").dataTable({
    "searching": true,
     mark: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend:'pdf',
            text: 'Download In PDF',
            className: 'red'
        },
        /*{
            extend: 'csv',
            text: 'Copy all data',
            exportOptions: {
                modifier: {
                search: 'none'
                }
            }
        }*/
    ]
  });
});
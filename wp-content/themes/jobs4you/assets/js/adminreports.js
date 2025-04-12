jQuery("document").ready(function () {
  jQuery("#customuserlist").dataTable({
    "searching": true,
     mark: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend:'pdf',
            text: 'Download In PDF',
            title: 'userspdf-'+getDateTime(),
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
  jQuery("#jobslist").dataTable({
    "searching": true,
     mark: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend:'pdf',
            text: 'Download In PDF',
            title: 'jobspdf-'+getDateTime(),
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
  jQuery("#jobseekerlist").dataTable({
    "searching": true,
    mark: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend:'pdf',
            text: 'Download In PDF',
            title: 'jobseekerpdf-'+getDateTime(),
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
  jQuery("#companylist").dataTable({
    "searching": true,
    mark: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend:'pdf',
            text: 'Download In PDF',
            title: 'companypdf-'+getDateTime(),
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
  function getDateTime(){
    var currentdate = new Date();
    var datetime = currentdate.getDate() + "-" + (currentdate.getMonth()+1) 
    + "-" + currentdate.getFullYear() + " " 
    + currentdate.getHours() + "-" 
    + currentdate.getMinutes() + "-" + currentdate.getSeconds();
    return datetime;
  }
  var minDate, maxDate;
  var table = jQuery('#customuserlist').DataTable();
  var jobstable = jQuery('#jobslist').DataTable();
  var jobseekerlist = jQuery('#jobseekerlist').DataTable();
  var companylist = jQuery('#companylist').DataTable();
  jQuery("#customuserlist_filter.dataTables_filter").append(jQuery("#rolesfilters"));
  jQuery("#customuserlist_filter.dataTables_filter").append(jQuery("#statusfilters"));
  jQuery("#customuserlist_filter.dataTables_filter, #jobslist_filter.dataTables_filter, #jobseekerlist_filter.dataTables_filter, #companylist_filter.dataTables_filter").append(jQuery("#min"));
  jQuery("#customuserlist_filter.dataTables_filter, #jobslist_filter.dataTables_filter, #jobseekerlist_filter.dataTables_filter, #companylist_filter.dataTables_filter").append(jQuery("#max"));
  jQuery("#jobslist_filter.dataTables_filter").append(jQuery("#jobtimingfilters"));
  jQuery("#jobslist_filter.dataTables_filter").append(jQuery("#categoryfilters"));
  jQuery("#jobslist_filter.dataTables_filter").append(jQuery("#experiencefilters"));
  var roleIndex = 0;
  var statusIndex = 0;
  var dateIndex = 0;
  var jobtimeIndex = 0;
  var categoryIndex = 0;
  var experienceIndex = 0;
  jQuery("#customuserlist th").each(function (i) {
    if (jQuery(jQuery(this)).html() == "Role") {
      roleIndex = i;
    }
    if (jQuery(jQuery(this)).html() == "Status") {
      statusIndex = i;
    }
    if (jQuery(jQuery(this)).html() == "Date") {
      dateIndex = i;
    }
  });
  jQuery("#jobslist th").each(function (i) {
    if (jQuery(jQuery(this)).html() == "Status") {
      statusIndex = i;
    }
    if (jQuery(jQuery(this)).html() == "Date") {
      dateIndex = i;
    }
    if (jQuery(jQuery(this)).html() == "Type") {
      jobtimeIndex = i;
    }
    if (jQuery(jQuery(this)).html() == "Category") {
      categoryIndex = i;
    }
    if (jQuery(jQuery(this)).html() == "Experience") {
      experienceIndex = i;
    }
  });
  jQuery("#jobseekerlist th").each(function (i) {
    if (jQuery(jQuery(this)).html() == "Date") {
      dateIndex = i;
    }
  });
  jQuery("#companylist th").each(function (i) {
    if (jQuery(jQuery(this)).html() == "Date") {
      dateIndex = i;
    }
  });
  jQuery.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      if(jQuery("#customuserlist").length){
        let selectedItem = jQuery('#rolesfilters').val()
        let category = data[roleIndex];
        if (selectedItem === "" || category.includes(selectedItem)) {
          return true;
        }
        return false;
      }else{
        return true;
      }
    }
  );
  jQuery.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      if(jQuery("#customuserlist").length){
        let selectedItem = jQuery('#statusfilters').val()
        let category = data[statusIndex];
        if (selectedItem === "" || category==selectedItem) {
          return true;
        }
        return false;
      }else{
        return true;
      }
    }
  );
  jQuery.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      if(jQuery("#customuserlist, #jobslist, #jobseekerlist, #companylist").length){
        let min = new Date(jQuery('#min').val());
        let max = new Date(jQuery('#max').val());
        let date = new Date( data[dateIndex] );
        if (
          ( isNaN(min) || isNaN(max) ) ||
          ( min === null && max === null ) ||
          ( min === null && date <= max ) ||
          ( min <= date   && max === null ) ||
          ( min <= date   && date <= max )
        ) {
          return true;
        }
        return false;
      }else{
        return true;
      }
    }
  );
  jQuery.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      if(jQuery("#jobslist").length){
        let selectedItem = jQuery('#jobtimingfilters').val()
        let category = data[jobtimeIndex];
        if (selectedItem === "" || category.includes(selectedItem)) {
          return true;
        }
        return false;
      }else{
        return true;
      }
    }
  );
  jQuery.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      if(jQuery("#jobslist").length){
        let selectedItem = jQuery('#categoryfilters').val()
        let category = data[categoryIndex];
        if (selectedItem === "" || category.includes(selectedItem)) {
          return true;
        }
        return false;
      }else{
        return true;
      }
    }
  );
  jQuery.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
      if(jQuery("#jobslist").length){
        let selectedItem = jQuery('#experiencefilters').val()
        let category = data[experienceIndex];
        if (selectedItem === "" || category.includes(selectedItem)) {
          return true;
        }
        return false;
      }else{
        return true;
      }
    }
  );
  jQuery("#rolesfilters, #statusfilters, #min, #max").change(function (e) {
    table.draw();
  });
  jQuery("#min, #max, #jobtimingfilters, #categoryfilters, #experiencefilters").change(function (e) {
    jobstable.draw();
  });
  jQuery("#min, #max").change(function (e) {
    jobseekerlist.draw();
  });
  jQuery("#min, #max").change(function (e) {
    companylist.draw();
  });

  table.draw();
  jobstable.draw();
  jobseekerlist.draw();
  companylist.draw();
});
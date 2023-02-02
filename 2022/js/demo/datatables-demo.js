// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTablecrianca').DataTable({
    "paging":   true,
      "ordering": false,
      "info":     false,
    "search": 'Pesquisar',
    "show": false,
  });
});

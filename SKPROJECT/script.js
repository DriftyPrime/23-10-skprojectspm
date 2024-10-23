function printTable() {
    var printContents = document.getElementById('patientTable').outerHTML;
    var printWindow = window.open('', '', 'height=500,width=800');
    printWindow.document.write('<!DOCTYPE html>');
    printWindow.document.write('<html><head><title>Print Table</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('table { width: 100%; border: 1px solid black; border-collapse: collapse; margin: 0 auto; }');
    printWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
    printWindow.document.write('th { background-color: #f2f2f2; }');
    printWindow.document.write('body { font-family: Arial, sans-serif; margin: 0; padding: 0; }');
    printWindow.document.write('@page { size: auto; margin: 15mm; }');
    printWindow.document.write('body { margin: 15mm; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');
    printContents = printContents.replace(/<a[^>]*>/g, '');
    printContents = printContents.replace(/<\/a>/g, '');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
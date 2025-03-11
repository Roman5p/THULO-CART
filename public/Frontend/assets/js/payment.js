document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
        this.classList.add('active');

        const paymentType = this.getAttribute('data-payment');
        const creditCardDetails = document.getElementById('credit-card-details');
        const imePayDetails = document.getElementById('ime-pay-details');
        const cashOnDeliveryDetails = document.getElementById('cash-on-delivery-details');
        const esewaDetails = document.getElementById('esewa-details');
        const khaltiDetails = document.getElementById('khalti-details');

        // Hide all details sections
        creditCardDetails.style.display = 'none';
        imePayDetails.style.display = 'none';
        cashOnDeliveryDetails.style.display = 'none';
        esewaDetails.style.display = 'none';
        khaltiDetails.style.display = 'none';

        // Show the relevant details section
        switch (paymentType) {
            case 'credit-card':
                creditCardDetails.style.display = 'block';
                break;
            case 'ime-pay':
                imePayDetails.style.display = 'block';
                break;
            case 'cash-on-delivery':
                cashOnDeliveryDetails.style.display = 'block';
                break;
            case 'esewa':
                esewaDetails.style.display = 'block';
                break;
            case 'khalti':
                khaltiDetails.style.display = 'block';
                break;
        }
    });
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
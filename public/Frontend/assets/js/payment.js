document.addEventListener('DOMContentLoaded', function() {
    const paymentOptions = document.querySelectorAll('.payment-option');
    if (paymentOptions.length === 0) {
        console.error('No .payment-option elements found');
        return;
    }

    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            paymentOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');

            const paymentType = this.getAttribute('data-payment');
            const creditCardDetails = document.getElementById('credit-card-details');
            const imePayDetails = document.getElementById('ime-pay-details');
            const cashOnDeliveryDetails = document.getElementById('cash-on-delivery-details');
            const esewaDetails = document.getElementById('esewa-details');
            const khaltiDetails = document.getElementById('khalti-details');

            if (!creditCardDetails || !imePayDetails || !cashOnDeliveryDetails || !esewaDetails || !khaltiDetails) {
                console.error('One or more payment detail elements not found');
                return;
            }

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
                default:
                    console.error('Unknown payment type:', paymentType);
            }
        });
    });
});

if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
} else {
    console.warn('Bootstrap Tooltip is not available');
}
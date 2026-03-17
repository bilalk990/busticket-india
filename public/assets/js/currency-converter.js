// Currency Converter for Real-time Price Updates
class CurrencyConverter {
    constructor() {
        this.exchangeRates = {};
        this.selectedCurrency = 'ZMW';
        this.currencySymbols = {
            'EUR': '€', 'USD': '$', 'GBP': '£', 'ZMW': 'ZK', 'KES': 'KSh',
            'NGN': '₦', 'GHS': '₵', 'UGX': 'USh', 'RWF': 'RF', 'TZS': 'TSh',
            'MWK': 'MK', 'CHF': 'CHF', 'PLN': 'zł', 'CZK': 'Kč', 'SEK': 'kr',
            'CNY': '￥', 'AUD': 'A$', 'CAD': 'CA$', 'MXN': 'MX$', 'DKK': 'DKK',
            'INR': '₹', 'NOK': 'NOK', 'BRL': 'R$', 'JPY': '¥', 'RON': 'L',
            'KRW': '₩', 'COP': 'CO$', 'UAH': '₴', 'HUF': 'Ft', 'CLP': 'CL$',
            'BGN': 'лв', 'HRK': 'kn', 'XAF': 'FCFA'
        };
        
        this.init();
    }
    
    init() {
        console.log('Currency converter initializing...');
        
        // Get exchange rates from meta tag
        const ratesMeta = document.querySelector('meta[name="exchange-rates"]');
        if (ratesMeta) {
            try {
                this.exchangeRates = JSON.parse(ratesMeta.getAttribute('content'));
                console.log('Loaded exchange rates from meta tag:', this.exchangeRates);
            } catch (e) {
                console.warn('Failed to parse exchange rates from meta tag:', e);
            }
        } else {
            console.warn('No exchange rates meta tag found');
        }
        
        // Get selected currency from meta tag
        const currencyMeta = document.querySelector('meta[name="selected-currency"]');
        if (currencyMeta) {
            this.selectedCurrency = currencyMeta.getAttribute('content') || 'ZMW';
            console.log('Selected currency from meta tag:', this.selectedCurrency);
        }
        
        // Store original price data
        this.storeOriginalPrices();
        
        // Listen for currency change events
        document.addEventListener('currencyChanged', (event) => {
            console.log('Currency changed event received:', event.detail);
            this.handleCurrencyChange(event.detail.currency);
        });
        
        console.log('Currency converter initialized successfully');
    }
    
    storeOriginalPrices() {
        console.log('Storing original prices...');
        
        // Store original price data for recent bookings table
        const priceCells = document.querySelectorAll('.recent-bookings-table tbody tr td:last-child');
        console.log('Found price cells:', priceCells.length);
        
        priceCells.forEach((cell, index) => {
            // Use data attributes if available
            const originalAmount = cell.getAttribute('data-original-amount');
            const originalCurrency = cell.getAttribute('data-original-currency');
            
            if (originalAmount && originalCurrency) {
                const originalData = {
                    amount: parseFloat(originalAmount),
                    currency: originalCurrency
                };
                cell.setAttribute('data-original-price', JSON.stringify(originalData));
                console.log(`Stored original price ${index}:`, originalData);
            } else {
                console.warn(`No data attributes found for cell ${index}`);
            }
        });
    }
    
    convertCurrency(amount, fromCurrency, toCurrency) {
        if (!amount || !fromCurrency || !toCurrency || fromCurrency === toCurrency) {
            return amount;
        }
        
        // Get the conversion rate from the exchange rates
        const fromRate = this.exchangeRates[fromCurrency] || 1;
        const toRate = this.exchangeRates[toCurrency] || 1;
        
        // Convert: (amount / fromRate) * toRate
        const converted = (amount / fromRate) * toRate;
        console.log(`Converting ${amount} ${fromCurrency} to ${converted} ${toCurrency} (fromRate: ${fromRate}, toRate: ${toRate})`);
        return converted;
    }
    
    formatCurrency(amount, currency) {
        const symbol = this.currencySymbols[currency] || currency;
        return symbol + ' ' + parseFloat(amount).toFixed(2);
    }
    
    updateAllPrices(newCurrency) {
        console.log('Updating all prices to:', newCurrency);
        
        // Update recent bookings table prices
        const priceCells = document.querySelectorAll('.recent-bookings-table tbody tr td:last-child');
        console.log('Updating price cells:', priceCells.length);
        
        priceCells.forEach((cell, index) => {
            const originalData = cell.getAttribute('data-original-price');
            if (originalData) {
                try {
                    const data = JSON.parse(originalData);
                    const convertedAmount = this.convertCurrency(data.amount, data.currency, newCurrency);
                    const formattedAmount = this.formatCurrency(convertedAmount, newCurrency);
                    cell.textContent = formattedAmount;
                    console.log(`Updated cell ${index}: ${data.amount} ${data.currency} -> ${formattedAmount}`);
                } catch (e) {
                    console.warn('Failed to parse original price data:', e);
                }
            } else {
                console.warn(`No original price data found for cell ${index}`);
            }
        });
    }
    
    handleCurrencyChange(newCurrency) {
        console.log('Handling currency change to:', newCurrency);
        if (newCurrency && newCurrency !== this.selectedCurrency) {
            this.selectedCurrency = newCurrency;
            this.updateAllPrices(newCurrency);
        } else if (newCurrency) {
            // Even if it's the same currency, still update prices to ensure they're correct
            console.log('Same currency selected, updating prices anyway...');
            this.updateAllPrices(newCurrency);
        }
    }
}

// Initialize currency converter when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, initializing currency converter...');
    window.currencyConverter = new CurrencyConverter();
    
    // Also make the handleCurrencyChange function available globally
    window.handleCurrencyChange = function(currencyValue) {
        if (window.currencyConverter) {
            window.currencyConverter.handleCurrencyChange(currencyValue);
        } else {
            console.warn('Currency converter not available yet');
        }
    };
});

// Fallback initialization in case DOMContentLoaded already fired
if (document.readyState === 'loading') {
    // DOM is still loading, wait for DOMContentLoaded
} else {
    // DOM is already loaded, initialize immediately
    console.log('DOM already loaded, initializing currency converter immediately...');
    window.currencyConverter = new CurrencyConverter();
    
    window.handleCurrencyChange = function(currencyValue) {
        if (window.currencyConverter) {
            window.currencyConverter.handleCurrencyChange(currencyValue);
        } else {
            console.warn('Currency converter not available yet');
        }
    };
} 
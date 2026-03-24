// Global Currency Converter for All Pages
class GlobalCurrencyConverter {
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
        console.log('Global currency converter initializing...');
        
        // Get exchange rates from meta tag
        const ratesMeta = document.querySelector('meta[name="exchange-rates"]');
        if (ratesMeta) {
            try {
                this.exchangeRates = JSON.parse(ratesMeta.getAttribute('content'));
                console.log('Loaded exchange rates from meta tag:', this.exchangeRates);
            } catch (e) {
                console.warn('Failed to parse exchange rates from meta tag:', e);
            }
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
        
        // Set up mutation observer for dynamic content
        this.setupMutationObserver();
        
        console.log('Global currency converter initialized successfully');
    }
    
    setupMutationObserver() {
        // Watch for new price elements being added to the DOM
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'childList') {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === Node.ELEMENT_NODE) {
                            this.processNewPriceElements(node);
                        }
                    });
                }
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
    
    processNewPriceElements(element) {
        // Look for price elements in the new content
        const priceElements = element.querySelectorAll('[data-original-amount], .price-amount, .main-price, .price-value');
        priceElements.forEach(el => {
            this.storeElementPrice(el);
        });
    }
    
    storeOriginalPrices() {
        console.log('Storing original prices...');
        
        // Store prices from various selectors
        const priceSelectors = [
            '[data-original-amount]',
            '.price-amount',
            '.main-price', 
            '.price-value',
            '.price-amount',
            '.stat-value',
            '.total-amount',
            '.fare-amount'
        ];
        
        priceSelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach((element, index) => {
                this.storeElementPrice(element);
            });
        });
    }
    
    storeElementPrice(element) {
        // Use data attributes if available
        const originalAmount = element.getAttribute('data-original-amount');
        const originalCurrency = element.getAttribute('data-original-currency');
        
        if (originalAmount && originalCurrency) {
            const originalData = {
                amount: parseFloat(originalAmount),
                currency: originalCurrency
            };
            element.setAttribute('data-original-price', JSON.stringify(originalData));
            console.log('Stored original price:', originalData);
        } else {
            // Try to extract from text content
            const text = element.textContent.trim();
            const priceMatch = text.match(/([A-Z]{3})\s*([\d,]+\.?\d*)/);
            if (priceMatch) {
                const currency = priceMatch[1];
                const amount = parseFloat(priceMatch[2].replace(/,/g, ''));
                const originalData = { amount, currency };
                element.setAttribute('data-original-price', JSON.stringify(originalData));
                console.log('Extracted and stored price:', originalData);
            }
        }
    }
    
    convertCurrency(amount, fromCurrency, toCurrency) {
        if (!amount || !fromCurrency || !toCurrency || fromCurrency === toCurrency) {
            return amount;
        }
        
        const fromRate = this.exchangeRates[fromCurrency] || 1;
        const toRate = this.exchangeRates[toCurrency] || 1;
        
        const converted = (amount / fromRate) * toRate;
        console.log(`Converting ${amount} ${fromCurrency} to ${converted} ${toCurrency}`);
        return converted;
    }
    
    formatCurrency(amount, currency) {
        const symbol = this.currencySymbols[currency] || currency;
        return symbol + ' ' + parseFloat(amount).toFixed(2);
    }
    
    updateAllPrices(newCurrency) {
        console.log('Updating all prices to:', newCurrency);
        
        // Update all price elements
        const priceSelectors = [
            '[data-original-price]',
            '.price-amount',
            '.main-price',
            '.price-value',
            '.stat-value',
            '.total-amount',
            '.fare-amount'
        ];
        
        priceSelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach((element, index) => {
                this.updateElementPrice(element, newCurrency);
            });
        });
        
        // Update form inputs with currency data
        this.updateFormInputs(newCurrency);
    }
    
    updateElementPrice(element, newCurrency) {
        const originalData = element.getAttribute('data-original-price');
        if (originalData) {
            try {
                const data = JSON.parse(originalData);
                const convertedAmount = this.convertCurrency(data.amount, data.currency, newCurrency);
                const formattedAmount = this.formatCurrency(convertedAmount, newCurrency);
                element.textContent = formattedAmount;
                console.log(`Updated element: ${data.amount} ${data.currency} -> ${formattedAmount}`);
            } catch (e) {
                console.warn('Failed to parse original price data:', e);
            }
        }
    }
    
    updateFormInputs(newCurrency) {
        // Update hidden currency inputs
        const currencyInputs = document.querySelectorAll('input[name="currency"], input[name="selected_currency"]');
        currencyInputs.forEach(input => {
            input.value = newCurrency;
        });
        
        // Update price range inputs
        const priceRanges = document.querySelectorAll('input[type="range"][data-base-min]');
        priceRanges.forEach(range => {
            const baseMin = parseFloat(range.getAttribute('data-base-min'));
            const baseMax = parseFloat(range.getAttribute('data-base-max'));
            const baseValue = parseFloat(range.getAttribute('data-base-value'));
            
            if (baseMin && baseMax && baseValue) {
                const convertedMin = this.convertCurrency(baseMin, 'ZMW', newCurrency);
                const convertedMax = this.convertCurrency(baseMax, 'ZMW', newCurrency);
                const convertedValue = this.convertCurrency(baseValue, 'ZMW', newCurrency);
                
                range.min = convertedMin;
                range.max = convertedMax;
                range.value = convertedValue;
                
                // Update display labels
                const labels = range.parentElement.querySelectorAll('.text-muted');
                if (labels.length >= 2) {
                    labels[0].textContent = `${convertedMin.toFixed(2)} ${newCurrency}`;
                    labels[1].textContent = `${convertedMax.toFixed(2)} ${newCurrency}`;
                }
                
                const valueDisplay = range.parentElement.querySelector('#priceRangeValue');
                if (valueDisplay) {
                    valueDisplay.textContent = `${convertedValue.toFixed(2)} ${newCurrency}`;
                }
            }
        });
    }
    
    handleCurrencyChange(newCurrency) {
        console.log('Handling currency change to:', newCurrency);
        if (newCurrency && newCurrency !== this.selectedCurrency) {
            this.selectedCurrency = newCurrency;
            this.updateAllPrices(newCurrency);
        } else if (newCurrency) {
            console.log('Same currency selected, updating prices anyway...');
            this.updateAllPrices(newCurrency);
        }
    }
    
    // Public method to manually trigger price updates
    refreshPrices() {
        this.storeOriginalPrices();
        this.updateAllPrices(this.selectedCurrency);
    }
}

// Initialize the global currency converter when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.globalCurrencyConverter = new GlobalCurrencyConverter();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = GlobalCurrencyConverter;
} 
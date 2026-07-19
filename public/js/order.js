const orderPrototypeVisuals = [
            { match: 'El Pollo Tacos', image: 'El pollo Taco.jpg', detail: 'Seasoned chicken tacos with onion, cilantro and Abuela’s savory sauce.' },
            { match: 'Nacho Birria', image: 'Nachos .jpg', detail: 'Crunchy nachos loaded with beef birria, melted cheese and fresh toppings.' },
            { match: 'Beef Birria Fries', image: '1.jpg', detail: 'A loaded birria favorite finished with cheese, pico de gallo and fresh cilantro.' },
            { match: 'Birria Pho', image: 'Group MEal.jpg', detail: 'A warm, comforting birria meal with Abuela’s deeply savory flavors.' },
            { match: 'Burrito - Beef', image: 'Burrito Beef.jpg', detail: 'A hearty tortilla packed with seasoned beef, Mexican rice and vegetables.' },
            { match: 'Burrito - Chicken', image: 'Burrito Beef.jpg', detail: 'A hearty tortilla packed with chicken, Mexican rice and vegetables.' },
            { match: 'Beef Birria Rice', image: 'Beef Birria Rice.jpg', detail: 'Slow-cooked beef birria with Mexican rice, pico de gallo and consommé.' },
            { match: 'El Pollo Rice', image: 'El Pollo RIce.jpg', detail: 'Seasoned chicken with Mexican rice, onions, cilantro and creamy sauce.' }
        ];

        document.querySelectorAll('.menu-item').forEach(function(menuItem) {
            if (menuItem.querySelector('.item-media')) return;

            const check = menuItem.querySelector('.item-check');
            const visual = orderPrototypeVisuals.find(function(rule) {
                return check.dataset.name.includes(rule.match);
            });

            if (!visual) return;

            const media = document.createElement('span');
            media.className = 'item-media';
            media.tabIndex = 0;
            media.setAttribute('aria-label', 'View details for ' + check.dataset.name);

            const image = document.createElement('img');
            image.src = document.body.dataset.assetsUrl + '/Food/Order-prototype/' + visual.image;
            image.alt = check.dataset.name;
            image.loading = 'lazy';

            const details = document.createElement('span');
            details.className = 'item-media-details';
            details.textContent = visual.detail;

            media.append(image, details);
            check.insertAdjacentElement('afterend', media);
        });

        const foodDialog = document.querySelector('#food-image-dialog');
        const foodDialogImage = document.querySelector('#food-dialog-image');
        const foodDialogTitle = document.querySelector('#food-dialog-title');
        const foodDialogDescription = document.querySelector('#food-dialog-description');
        const foodDialogClose = document.querySelector('#food-dialog-close');
        let lastFoodTrigger = null;

        function openFoodDialog(media) {
            const item = media.closest('.menu-item');
            const check = item.querySelector('.item-check');
            const sourceImage = media.querySelector('img');
            const description = media.querySelector('.item-media-details');

            lastFoodTrigger = media;
            foodDialogImage.src = sourceImage.currentSrc || sourceImage.src;
            foodDialogImage.alt = sourceImage.alt;
            foodDialogTitle.textContent = check.dataset.name;
            foodDialogDescription.textContent = description ? description.textContent : '';
            foodDialog.showModal();
        }

        document.querySelectorAll('.item-media').forEach(function(media) {
            media.setAttribute('role', 'button');
            media.setAttribute('aria-haspopup', 'dialog');

            media.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                openFoodDialog(media);
            });

            media.addEventListener('keydown', function(event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    event.stopPropagation();
                    openFoodDialog(media);
                }
            });
        });

        foodDialogClose.addEventListener('click', function() {
            foodDialog.close();
        });

        foodDialog.addEventListener('click', function(event) {
            if (event.target === foodDialog) foodDialog.close();
        });

        foodDialog.addEventListener('close', function() {
            foodDialogImage.src = '';
            if (lastFoodTrigger) lastFoodTrigger.focus();
        });

        const messengerBaseUrl = 'https://m.me/AbuelaCantina';
        const paymentNotice = 'All order will only be processed once proof of payment is sent.';

        const form = document.querySelector('#order-form');
        const itemChecks = document.querySelectorAll('.item-check');
        const summaryList = document.querySelector('#summary-list');
        const summaryTotal = document.querySelector('#summary-total');
        const messagePreview = document.querySelector('#message-preview');

        function getSelectedItems() {
            return Array.from(itemChecks)
                .filter(function(check) {
                    return check.checked;
                })
                .map(function(check) {
                    const qtyInput = check.closest('.menu-item').querySelector('.item-qty');
                    const quantity = Math.max(1, Number(qtyInput.value) || 1);
                    const price = Number(check.dataset.price);

                    return {
                        name: check.dataset.name,
                        price: price,
                        quantity: quantity,
                        subtotal: price * quantity
                    };
                });
        }

        function peso(amount) {
            return 'P' + amount.toLocaleString('en-PH');
        }

        function updateSummary() {
            const selectedItems = getSelectedItems();
            const total = selectedItems.reduce(function(sum, item) {
                return sum + item.subtotal;
            }, 0);

            if (selectedItems.length === 0) {
                summaryList.innerHTML = '<p class="summary-empty">No items selected yet.</p>';
            } else {
                summaryList.innerHTML = selectedItems.map(function(item) {
                    return '<div class="summary-row"><span>' + item.quantity + ' x ' + item.name + '</span><span>' + peso(item.subtotal) + '</span></div>';
                }).join('');
            }

            summaryTotal.textContent = peso(total);
        }

        function buildOrderMessage() {
            const selectedItems = getSelectedItems();
            const name = document.querySelector('#customer-name').value.trim();
            const phone = document.querySelector('#customer-phone').value.trim();
            const email = document.querySelector('#customer-email').value.trim();
            const notes = document.querySelector('#order-notes').value.trim();
            const total = selectedItems.reduce(function(sum, item) {
                return sum + item.subtotal;
            }, 0);
            const orderLines = selectedItems.map(function(item) {
                return '- ' + item.quantity + ' x ' + item.name + ' @ ' + peso(item.price) + ' = ' + peso(item.subtotal);
            }).join('\n');

            return [
                'Hello Abuela Cantina, I would like to order:',
                '',
                orderLines,
                '',
                'Notes: ' + (notes || 'None'),
                '',
                'Total: ' + peso(total),
                '',
                'Customer Details:',
                'Name: ' + name,
                'Phone: ' + phone,
                'Email: ' + email,
                '',
                paymentNotice
            ].join('\n');
        }

        itemChecks.forEach(function(check) {
            const qtyInput = check.closest('.menu-item').querySelector('.item-qty');

            check.addEventListener('change', function() {
                qtyInput.disabled = !check.checked;
                if (check.checked && Number(qtyInput.value) < 1) {
                    qtyInput.value = 1;
                }
                updateSummary();
            });

            qtyInput.addEventListener('input', updateSummary);
        });

        form.addEventListener('reset', function() {
            setTimeout(function() {
                document.querySelectorAll('.item-qty').forEach(function(input) {
                    input.disabled = true;
                    input.value = 1;
                });
                messagePreview.style.display = 'none';
                messagePreview.textContent = '';
                updateSummary();
            }, 0);
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            if (getSelectedItems().length === 0) {
                alert('Please select at least one item before checkout.');
                return;
            }

            if (!form.reportValidity()) {
                return;
            }

            const message = buildOrderMessage();
            const encodedMessage = encodeURIComponent(message);
            const checkoutUrl = messengerBaseUrl + '?text=' + encodedMessage;

            messagePreview.style.display = 'block';
            messagePreview.textContent = message;

            if (navigator.clipboard) {
                navigator.clipboard.writeText(message);
            }

            alert(paymentNotice);
            window.location.href = checkoutUrl;
        });

        updateSummary();

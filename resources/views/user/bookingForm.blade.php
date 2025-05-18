@extends('user.generalLayout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header text-white text-center rounded-top-4" style="background-color: #178066;">
                        <h4 class="mb-0">Book an Appointment</h4>
                    </div>
                    <div class="card-body p-4">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('booking.store') }}">
                            @csrf

                            <!-- Select Service -->
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Choose a Service</label>
                                <select id="service_id" name="service_id" class="form-control" required>
                                    <option value="">Select a service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Select Organization -->
                            <div class="mb-3">
                                <label for="organization_id" class="form-label">Choose an Organization</label>
                                <select id="organization_id" name="organization_id" class="form-control" required>
                                    <option value="">Select an organization</option>
                                </select>
                            </div>

                            <!-- Booking Date -->
                            <div class="mb-3">
                                <label for="booking_date" class="form-label">Select Date</label>
                                <input type="date" name="booking_date" id="booking_date" class="form-control" required
                                    min="{{ now()->format('Y-m-d') }}">
                            </div>

                            <!-- Booking Time -->
                            <div class="mb-3">
                                <label for="booking_time" class="form-label">Select Time</label>
                                <select name="booking_time" id="booking_time" class="form-control" required disabled>
                                    <option value="">Select a date first</option>
                                </select>
                                <small class="text-muted" id="timeSlotInfo"></small>
                            </div>

                            <!-- Display Price -->
                            <div class="mb-3">
                                <label class="form-label">Service Price</label>
                                <input type="text" class="form-control" id="price_display" disabled>
                                <input type="hidden" name="price" id="price">
                            </div>

                            <!-- Payment Method Selection -->
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select id="payment_method" name="payment_method" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="online">Online Payment</option>
                                </select>
                            </div>

                            <!-- Online Payment Details (hidden initially) -->
                            <div id="onlinePaymentDetails" class="d-none">
                                <div class="mb-3">
                                    <label for="card_number" class="form-label">Card Number</label>
                                    <input type="text" name="card_number" id="card_number" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="expiration_date" class="form-label">Expiration Date</label>
                                    <input type="month" name="expiration_date" id="expiration_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" name="cvv" id="cvv" class="form-control">
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn2 px-5 mr-2" id="submitBtn">Book Now</button>
                                <a href="{{ url()->previous() }}" class="btn2" style="background-color: gray">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const serviceSelect = document.getElementById('service_id');
        const orgSelect = document.getElementById('organization_id');
        const dateInput = document.getElementById('booking_date');
        const timeSelect = document.getElementById('booking_time');
        const priceDisplay = document.getElementById('price_display');
        const priceHidden = document.getElementById('price');
        const timeSlotInfo = document.getElementById('timeSlotInfo');
        const submitBtn = document.getElementById('submitBtn');
        let employeeCount = 0;

        // Load organizations on service select
        serviceSelect.addEventListener('change', function() {
            const serviceId = this.value;

            orgSelect.innerHTML = '<option value="">Select an organization</option>';
            resetForm();

            if (!serviceId) return;

            fetch(`/get-organizations/${serviceId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(org => {
                        const option = document.createElement('option');
                        option.value = org.id;
                        option.textContent = org.name;
                        orgSelect.appendChild(option);
                    });
                });
        });

        // On date change, generate available time slots
        dateInput.addEventListener('change', function() {
            if (orgSelect.value) {
                updateTimeOptions();
            }
        });

        function generateTimes() {
            let times = [];
            const now = new Date();
            const selectedDate = new Date(dateInput.value);
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            for (let h = 8; h <= 17; h++) {
                const time = ('0' + h).slice(-2) + ':00';
                const timeObj = new Date(selectedDate);
                timeObj.setHours(h, 0, 0, 0);

                if (selectedDate > today || (selectedDate.getTime() === today.getTime() && timeObj > now)) {
                    times.push(time);
                }
            }
            return times;
        }

        function updateTimeOptions() {
            timeSelect.innerHTML = '';
            const selectedDate = dateInput.value;

            if (!selectedDate) {
                timeSelect.disabled = true;
                return;
            }

            const availableTimes = generateTimes();

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select a time';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            timeSelect.appendChild(defaultOption);

            availableTimes.forEach(time => {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                timeSelect.appendChild(option);
            });

            timeSelect.disabled = false;
            checkBookedSlots();
        }

        // On organization change, fetch price and employee info
        orgSelect.addEventListener('change', fetchPriceAndEmployee);

        fetchPriceAndEmployee();

        if (dateInput.value) {
            updateTimeOptions();
        }

        function fetchPriceAndEmployee() {
            const serviceId = serviceSelect.value;
            const orgId = orgSelect.value;

            if (!serviceId || !orgId) return;

            fetch(`/get-price-and-available-employee/${serviceId}/${orgId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        resetForm();
                    } else {
                        priceDisplay.value = data.price + ' JD';
                        priceHidden.value = data.price;
                        employeeCount = data.employee_count;
                        timeSlotInfo.textContent = `This organization has ${employeeCount} employee(s) available`;

                        if (dateInput.value) {
                            checkBookedSlots();
                        }
                    }
                })
                .catch(err => {
                    alert("Something went wrong. Please try again.");
                    console.error(err);
                    resetForm();
                });
        }

        function checkBookedSlots() {
            const orgId = orgSelect.value;
            const selectedDate = dateInput.value;

            if (!orgId || !selectedDate) return;

            fetch(`/get-booked-slots/${serviceSelect.value}/${orgId}`)
                .then(res => res.json())
                .then(data => {
                        const bookedSlotsForDate = data[selectedDate] || [];
                        const fullyBookedTimes = [];

                        // Count bookings per time slot
                        const bookingCounts = {};
                        bookedSlotsForDate.forEach(time => {
                            bookingCounts[time] = (bookingCounts[time] || 0) + 1;
                        });

                        // Find times where all employees are booked
                        for (const [time, count] of Object.entries(bookingCounts)) {
                            if (count >= employeeCount) {
                                fullyBookedTimes.push(time);
                            }
                        }

                        // Disable fully booked times
                        timeSelect.querySelectorAll('option').forEach(option => {
                                if (option.value && fullyBookedTimes.includes(option.value)) {
                                    option.disabled = true;
                                    option.style.color = '#999';
                                    option.textContent += ' (Fully booked)';
                                }
                            else if (new Date(dateInput.value).toDateString() === new Date().toDateString()) {
                                const now = new Date();
                                const [hour, minute] = option.value.split(':');
                                const optionTime = new Date(now);
                                optionTime.setHours(hour, minute, 0, 0);
                                if (optionTime <= now) {
                                    option.disabled = true;
                                    option.style.color = '#999';
                                    option.textContent += ' (Past time)';
                                }
                            }

                        });

                    // Enable/disable submit button based on availability
                    const hasAvailableSlots = Array.from(timeSelect.options).some(
                        option => option.value && !option.disabled
                    );

                    submitBtn.disabled = !hasAvailableSlots;
                    if (!hasAvailableSlots) {
                        timeSlotInfo.textContent = 'No available time slots for this date';
                        timeSlotInfo.style.color = 'red';
                    } else {
                        timeSlotInfo.style.color = '';
                    }
                })
        .catch(err => {
            console.error("Error fetching booked slots:", err);
        });
        }

        function resetForm() {
            priceDisplay.value = '';
            priceHidden.value = '';
            timeSelect.innerHTML = '';
            timeSelect.disabled = true;
            timeSlotInfo.textContent = '';
            submitBtn.disabled = false;
            employeeCount = 0;
        }

        // When time is selected, verify availability one more time
        timeSelect.addEventListener('change', function() {
            if (this.value) {
                checkBookedSlots();
            }
        });

        // Payment Method Toggle
        const paymentMethodSelect = document.getElementById('payment_method');
        const onlinePaymentDetails = document.getElementById('onlinePaymentDetails');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'online') {
                onlinePaymentDetails.classList.remove('d-none');
            } else {
                onlinePaymentDetails.classList.add('d-none');
            }
        });
    </script>
@endsection

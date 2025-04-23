@extends('user.generalLayout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header text-white text-center rounded-top-4" style="background-color: #178066;">
                        <h4 class="mb-0">Book an Appointment for {{ $service->name }} at {{ $organization->name }}</h4>
                    </div>
                    <div class="card-body p-4">

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form
                            action="{{ route('saveBooking', ['serviceId' => $service->id, 'organizationId' => $organization->id]) }}"
                            method="POST">
                            @csrf

                            <!-- Hidden Employee Field -->
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">

                            <!-- Service Information -->
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <input type="text" class="form-control" value="{{ $service->name }}" readonly>
                            </div>

                            <!-- Organization Information -->
                            <div class="mb-3">
                                <label class="form-label">Organization</label>
                                <input type="text" class="form-control" value="{{ $organization->name }}" readonly>
                            </div>

                            <!-- Booking Date -->
                            <div class="mb-3">
                                <label for="booking_date" class="form-label">Select Date</label>
                                <input type="date" name="booking_date" id="booking_date" class="form-control"
                                    required min="{{ now()->format('Y-m-d') }}">
                            </div>

                            <!-- Booking Time -->
                            <div class="mb-3">
                                <label for="booking_time" class="form-label">Select Time</label>
                                <select name="booking_time" id="booking_time" class="form-select" required disabled>
                                    <option value="">Select a date first</option>
                                </select>
                                <small class="text-muted" id="timeSlotInfo"></small>
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

                            <!-- Submit Buttons -->
                            <div class="d-flex text-center mt-4 justify-content-center">
                                <button type="submit" class="btn2 px-5 mr-2" id="submitBtn">Book Appointment</button>
                                <a href="{{ url()->previous() }}" class="btn2" style="background-color: gray">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const bookedSlots = @json($bookedSlots);
        const timeSelect = document.getElementById('booking_time');
        const dateInput = document.getElementById('booking_date');
        const timeSlotInfo = document.getElementById('timeSlotInfo');
        const submitBtn = document.getElementById('submitBtn');
        const paymentMethodSelect = document.getElementById('payment_method');
        const onlinePaymentDetails = document.getElementById('onlinePaymentDetails');

        // Generate available times based on selected date
        const generateTimes = () => {
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
        };

        const updateTimeOptions = () => {
            timeSelect.innerHTML = '';
            const selectedDate = dateInput.value;

            if (!selectedDate) {
                timeSelect.disabled = true;
                return;
            }

            const availableTimes = generateTimes();
            const booked = bookedSlots[selectedDate] || [];

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select a time';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            timeSelect.appendChild(defaultOption);

            let availableCount = 0;

            availableTimes.forEach(time => {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                if (booked.includes(time)) {
                    option.disabled = true;
                    option.style.color = '#999';
                    option.textContent += ' (Booked)';
                } else {
                    availableCount++;
                }
                timeSelect.appendChild(option);
            });

            timeSelect.disabled = false;

            // Update time slot information
            if (availableCount === 0) {
                timeSlotInfo.textContent = 'No available time slots for this date';
                timeSlotInfo.style.color = 'red';
                submitBtn.disabled = true;
            } else {
                timeSlotInfo.textContent = `${availableCount} time slot(s) available`;
                timeSlotInfo.style.color = '';
                submitBtn.disabled = false;
            }
        };

        dateInput.addEventListener('change', updateTimeOptions);

        // Initial check if date is already selected (e.g., when form validation fails)
        if (dateInput.value) {
            updateTimeOptions();
        }

        // Toggle online payment details visibility based on selected payment method
        paymentMethodSelect.addEventListener('change', function () {
            if (this.value === 'online') {
                onlinePaymentDetails.classList.remove('d-none');
            } else {
                onlinePaymentDetails.classList.add('d-none');
            }
        });
    </script>

@endsection

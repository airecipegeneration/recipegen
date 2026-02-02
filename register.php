<?php
// register.php - v5 - FINAL CORRECTED VERSION

require_once __DIR__ . '/config.php';
$page_title = 'Create an Account';
// Base path is set by config.php/config.local.php
if (!isset($base_path)) {
    $base_path = '/';
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get old form input from session if it exists
$form_input = $_SESSION['form_input'] ?? [];
unset($_SESSION['form_input']); // Clear it after use

include __DIR__ . '/templates/header.php';
?>

<main class="bg-gray-50">
    <div class="flex flex-col justify-center py-20 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md" data-aos="fade-up">
            <a href="<?php echo $base_path; ?>" class="flex justify-center text-4xl font-bold text-primary">🍳</a>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-text-main">Create your account</h2>
            <p class="mt-2 text-center text-sm text-text-secondary">Join us and start creating delicious recipes.</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-white py-8 px-4 shadow-lg sm:rounded-lg sm:px-10">
                <?php
                if (isset($_SESSION['register_error'])): ?>
                    <div class="mb-4 rounded-md bg-red-50 p-4">
                        <p class="text-sm text-center text-red-700">
                            <?php echo htmlspecialchars($_SESSION['register_error']); ?></p>
                    </div>
                    <?php unset($_SESSION['register_error']);
                endif; ?>

                <form id="register-form" class="space-y-6" action="handle_register.php" method="POST">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-text-main">First Name</label>
                            <div class="mt-1">
                                <input id="first_name" name="first_name" type="text" autocomplete="given-name" required
                                    value="<?php echo htmlspecialchars($form_input['first_name'] ?? ''); ?>"
                                    class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-text-main">Last Name</label>
                            <div class="mt-1">
                                <input id="last_name" name="last_name" type="text" autocomplete="family-name" required
                                    value="<?php echo htmlspecialchars($form_input['last_name'] ?? ''); ?>"
                                    class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-main">Email address</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="<?php echo htmlspecialchars($form_input['email'] ?? ''); ?>"
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-text-main">Phone Number</label>
                        <div class="mt-1">
                            <input id="phone_number" name="phone_number" type="tel" autocomplete="tel" required
                                value="<?php echo htmlspecialchars($form_input['phone_number'] ?? ''); ?>"
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>

                    <!-- Address Fields -->
                    <div>
                        <label for="address_street" class="block text-sm font-medium text-text-main">Street
                            Address</label>
                        <div class="mt-1">
                            <input id="address_street" name="address_street" type="text" autocomplete="street-address"
                                required value="<?php echo htmlspecialchars($form_input['address_street'] ?? ''); ?>"
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div>
                            <label for="address_city" class="block text-sm font-medium text-text-main">City</label>
                            <div class="mt-1">
                                <input id="address_city" name="address_city" type="text" autocomplete="address-level2"
                                    required value="<?php echo htmlspecialchars($form_input['address_city'] ?? ''); ?>"
                                    class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                        </div>
                        <div>
                            <label for="address_zip" class="block text-sm font-medium text-text-main">Post/Zip
                                Code</label>
                            <div class="mt-1">
                                <input id="address_zip" name="address_zip" type="text" autocomplete="postal-code"
                                    required value="<?php echo htmlspecialchars($form_input['address_zip'] ?? ''); ?>"
                                    class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="address_country" class="block text-sm font-medium text-text-main">Country</label>
                        <div class="mt-1">
                            <select id="address_country" name="address_country" autocomplete="country-name" required
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm bg-white">
                                <option value="" disabled <?php echo empty($form_input['address_country']) ? 'selected' : ''; ?>>Select a country</option>
                                <?php
                                $countries = [
                                    "Albania",
                                    "Algeria",
                                    "Andorra",
                                    "Angola",
                                    "Antigua and Barbuda",
                                    "Argentina",
                                    "Armenia",
                                    "Australia",
                                    "Austria",
                                    "Azerbaijan",
                                    "Bahamas",
                                    "Bahrain",
                                    "Bangladesh",
                                    "Barbados",
                                    "Belgium",
                                    "Belize",
                                    "Benin",
                                    "Bhutan",
                                    "Bolivia",
                                    "Bosnia and Herzegovina",
                                    "Botswana",
                                    "Brazil",
                                    "Brunei",
                                    "Bulgaria",
                                    "Burkina Faso",
                                    "Burundi",
                                    "Cabo Verde",
                                    "Cambodia",
                                    "Cameroon",
                                    "Canada",
                                    "Chad",
                                    "Chile",
                                    "China",
                                    "Colombia",
                                    "Comoros",
                                    "Costa Rica",
                                    "Croatia",
                                    "Cyprus",
                                    "Czech Republic",
                                    "Denmark",
                                    "Djibouti",
                                    "Dominica",
                                    "Dominican Republic",
                                    "East Timor",
                                    "Ecuador",
                                    "Egypt",
                                    "El Salvador",
                                    "Equatorial Guinea",
                                    "Eritrea",
                                    "Estonia",
                                    "Eswatini",
                                    "Ethiopia",
                                    "Fiji",
                                    "Finland",
                                    "France",
                                    "Gabon",
                                    "Gambia",
                                    "Georgia",
                                    "Germany",
                                    "Ghana",
                                    "Greece",
                                    "Grenada",
                                    "Guatemala",
                                    "Guinea",
                                    "Guinea-Bissau",
                                    "Guyana",
                                    "Honduras",
                                    "Hungary",
                                    "Iceland",
                                    "India",
                                    "Indonesia",
                                    "Ireland",
                                    "Israel",
                                    "Italy",
                                    "Jamaica",
                                    "Japan",
                                    "Jordan",
                                    "Kazakhstan",
                                    "Kenya",
                                    "Kiribati",
                                    "Kosovo",
                                    "Kuwait",
                                    "Kyrgyzstan",
                                    "Laos",
                                    "Latvia",
                                    "Lebanon",
                                    "Lesotho",
                                    "Liberia",
                                    "Libya",
                                    "Liechtenstein",
                                    "Lithuania",
                                    "Luxembourg",
                                    "Madagascar",
                                    "Malawi",
                                    "Malaysia",
                                    "Maldives",
                                    "Malta",
                                    "Marshall Islands",
                                    "Mauritania",
                                    "Mauritius",
                                    "Mexico",
                                    "Micronesia",
                                    "Moldova",
                                    "Monaco",
                                    "Mongolia",
                                    "Montenegro",
                                    "Morocco",
                                    "Mozambique",
                                    "Namibia",
                                    "Nauru",
                                    "Nepal",
                                    "Netherlands",
                                    "New Zealand",
                                    "Nicaragua",
                                    "Niger",
                                    "Nigeria",
                                    "North Macedonia",
                                    "Norway",
                                    "Oman",
                                    "Pakistan",
                                    "Palau",
                                    "Panama",
                                    "Papua New Guinea",
                                    "Paraguay",
                                    "Peru",
                                    "Philippines",
                                    "Poland",
                                    "Portugal",
                                    "Qatar",
                                    "Romania",
                                    "Rwanda",
                                    "Saint Kitts and Nevis",
                                    "Saint Lucia",
                                    "Saint Vincent and the Grenadines",
                                    "Samoa",
                                    "San Marino",
                                    "Sao Tome and Principe",
                                    "Saudi Arabia",
                                    "Senegal",
                                    "Serbia",
                                    "Seychelles",
                                    "Sierra Leone",
                                    "Singapore",
                                    "Slovakia",
                                    "Slovenia",
                                    "Solomon Islands",
                                    "South Africa",
                                    "South Korea",
                                    "Spain",
                                    "Sri Lanka",
                                    "Suriname",
                                    "Sweden",
                                    "Switzerland",
                                    "Taiwan",
                                    "Tajikistan",
                                    "Tanzania",
                                    "Thailand",
                                    "Togo",
                                    "Tonga",
                                    "Trinidad and Tobago",
                                    "Tunisia",
                                    "Turkey",
                                    "Turkmenistan",
                                    "Tuvalu",
                                    "Uganda",
                                    "Ukraine",
                                    "United Arab Emirates",
                                    "United Kingdom",
                                    "United States",
                                    "Uruguay",
                                    "Uzbekistan",
                                    "Vanuatu",
                                    "Vatican City",
                                    "Vietnam",
                                    "Zambia"
                                ];
                                foreach ($countries as $country) {
                                    $selected = ($form_input['address_country'] ?? '') === $country ? 'selected' : '';
                                    echo "<option value=\"" . htmlspecialchars($country) . "\" $selected>" . htmlspecialchars($country) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="dob" class="block text-sm font-medium text-text-main">Date of Birth</label>
                        <div class="mt-1">
                            <input id="dob" name="dob" type="date" required
                                value="<?php echo htmlspecialchars($form_input['dob'] ?? ''); ?>"
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-text-main">Company <span
                                class="text-text-secondary">(Optional)</span></label>
                        <div class="mt-1">
                            <input id="company" name="company" type="text" autocomplete="organization"
                                value="<?php echo htmlspecialchars($form_input['company'] ?? ''); ?>"
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-text-main">Password</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-text-main">Confirm
                            Password</label>
                        <div class="mt-1">
                            <input id="confirm_password" name="confirm_password" type="password"
                                autocomplete="new-password" required
                                class="appearance-none block w-full px-3 py-2 border border-border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>
                    <div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="agree_terms" name="agree_terms" type="checkbox"
                                    class="h-4 w-4 text-primary focus:ring-primary border-border rounded" />
                            </div>
                            <label for="agree_terms" class="ml-3 text-sm text-text-secondary">
                                I have read and agree to the
                                <a href="<?php echo $base_path; ?>pages/terms-and-conditions"
                                    class="text-primary font-semibold hover:underline">Terms and Conditions</a>
                            </label>
                        </div>
                        <p id="terms-error" class="mt-2 text-sm text-red-600 hidden">
                            Please confirm that you have read and agree to the Terms and Conditions.
                        </p>
                    </div>
                    <div>
                        <button id="register-submit" type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary opacity-60 cursor-not-allowed"
                            disabled>
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-border"></div>
                        </div>
                        <div class="relative flex justify-center text-sm"><span
                                class="px-2 bg-white text-text-secondary">Or continue with</span></div>
                    </div>
                    <div class="mt-6">
                        <a href="google_auth.php"
                            class="w-full inline-flex justify-center py-2 px-4 border border-border rounded-md shadow-sm bg-white text-sm font-medium text-text-secondary hover:bg-gray-50">
                            <span class="sr-only">Sign in with Google</span>
                            <svg class="w-5 h-5" aria-hidden="true" viewBox="0 0 24 24">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                                <path d="M1 1h22v22H1z" fill="none" />
                            </svg>
                        </a>
                    </div>
                </div>
                <p class="mt-8 text-center text-sm text-text-secondary">
                    Already a member?
                    <a href="<?php echo $base_path; ?>login" class="font-medium text-primary hover:underline">Log in
                        here</a>
                </p>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('register-form');
        const checkbox = document.getElementById('agree_terms');
        const submitButton = document.getElementById('register-submit');
        const errorMessage = document.getElementById('terms-error');

        if (!form || !checkbox || !submitButton) {
            return;
        }

        const toggleSubmitState = () => {
            const isChecked = checkbox.checked;
            submitButton.disabled = !isChecked;
            submitButton.classList.toggle('opacity-60', !isChecked);
            submitButton.classList.toggle('cursor-not-allowed', !isChecked);
            if (isChecked && errorMessage) {
                errorMessage.classList.add('hidden');
            }
        };

        checkbox.addEventListener('change', toggleSubmitState);

        form.addEventListener('submit', (event) => {
            if (!checkbox.checked) {
                event.preventDefault();
                if (errorMessage) {
                    errorMessage.classList.remove('hidden');
                }
                checkbox.focus();
            }
        });
    });
</script>
<?php include __DIR__ . '/templates/footer.php'; ?>
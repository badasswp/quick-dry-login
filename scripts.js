/**
 * Event Listener for ID: 'quick-dry-select'.
 *
 * Hit WP REST endpoint with the selected user ID value, if successful,
 * redirect the user to admin page, authenticate session.
 *
 * @event change
 * @param {Event} evt - The event object.
 */
document.getElementById('quick-dry-select').addEventListener('change',
	async function (evt) {
		if (!this.value) {
			return;
		}
    try {
      const response = await fetch(
        `${quickDryLogin.restUrl}/${quickDryLogin.nonce}/${this.value}`,
        { method: 'GET' }
      );

      const { userId } = await response.json();

      if (userId) {
        window.location.href = quickDryLogin.redirect;
      }
    } catch (error) {
      const { status } = await error.json();

      console.log(
        `Fatal Error: ${status}, Unable to login user with ID: ${this.value}`
      )
		}
	}
);

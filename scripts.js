/**
 * Event Listener: ID - 'quick-dry-select'.
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
			const userId = await fetch(
				`${quickDryLogin.restUrl}/${quickDryLogin.nonce}/${this.value}`,
				{ method: 'GET' }
			)
				.then((response) => response.json())
				.then((json) => json.userId);

			window.location.href = quickDryLogin.redirect;
		} catch (err) {
			alert(err);
		}
	}
);
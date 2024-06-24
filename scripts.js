document.getElementById('quick-dry-select').addEventListener('change',
	async function (evt) {
		if (!this.value) {
			return;
		}
		try {
			const userId = await fetch(
				`${quickDryLogin.restUrl}/${this.value}`,
				{ method: 'POST' }
			)
				.then((response) => response.json())
				.then((json) => json.userId);

			window.location.href = quickDryLogin.destination;
		} catch (err) {
			alert(err);
		}
	}
);
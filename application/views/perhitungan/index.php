<div class="showback mt-3">
	<div class="card-body">
		<div class="row mt-3 ">
			<div class="col-md-10">
				<h3> Data Alternatif</h3>
			</div>
			<div class="col-md-2"></div>
		</div>

		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No KK</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Peringkat</th>
					</tr>
				</thead>
				<tbody id="tabel_peringkat">
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
	const getData = async () => {
		return await axios.get(`<?= base_url('perhitungan/ajax') ?>`).then(res => res.data);
	}

	const getResult = async (data) => {
		console.log(data)
		return await axios.post(`http://localhost:5000/calculate`,
			data, {
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(res => res.data);
	}

	const showData = async () => {
		const result = await getData().then(res => res);
		console.log(result);

		let hasil = await getResult(result).then(res => res.data);

		if (hasil) {
			hasil = hasil.replace(/'/g, `"`);
			hasil = JSON.parse(hasil)
			console.log(hasil)
		}

		let temp = ``;
		let peringkat = 1;

		for (let h in hasil) {
			console.log(h)
			result.forEach(res => {
				if (hasil[h] == res.no_kk) {
					console.log(res)
					temp += `<tr>
						<td>${res.no_kk}</td>
						<td>${res.nik}</td>
						<td>${res.nama}</td>
						<td>${peringkat++}</td>
					</tr>`;
				}
			})
		}

		document.getElementById('tabel_peringkat').innerHTML = temp;

		console.log(temp)
	}

	window.addEventListener('load', async () => {
		await showData()
	})
</script>
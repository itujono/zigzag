<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
	<div class="ui grid">
		<div class="sixteen wide column">
			<div class="header">
				<h3>Mau Ngembaliin Barang?</h3>
				Meskipun kami sedih, tapi kamu tetap harus menunjukkan alasannya di form berikut ini ya. Awas!
			</div>
			<form class="ui form" id="retur-form">
				<div class="required field">
					<label for="merkBarang">Merk dan jenis barang</label>
					<input type="text" name="merkBarang" placeholder="Misal: Pouch bag Andalas X1">
				</div>
				<div class="two fields">
					<div class="required field">
						<label for="nomorOrder">Nomor order</label>
						<input type="text" name="nomorOrder" value="" placeholder="Misal: LX293423">
					</div>
					<div class="required field">
						<label for="kodeBarang">Kode barang</label>
						<input type="text" name="kodeBarang" value="" placeholder="Misal: VX24399">
					</div>
				</div>
				<div class="required field">
					<label for="alasanRetur">Alasan ingin meretur barang</label>
					<textarea name="alasanRetur" rows="6" placeholder="Misal: Barang tidak sesuai harapan"></textarea>
				</div>
				<div class="ui divider"></div>
				<div class="required inline field mb2em">
					<div class="ui checkbox">
						<input type="checkbox" tabindex="0" class="hidden" name="persetujuan">
						<label for="persetujuan">Saya menjamin data yang saya input di atas adalah jujur dan adil</label>
					</div>
				</div>
				<input type="submit" class="ui zz button" value="Konfirmasi retur"></button>
				<a href="/" class="ui direct basic button"><i class="angle left icon"></i> Kembali ke Home</a>
			</form>
		</div>
	</div>
	<div class="ui page dimmer">
		<div class="content">
			<div class="center">
				<h2 class="ui inverted icon header">
					<i class="heart icon"></i>
					Okay, terima kasih udah luangin waktunya, ya. <br> Meskipun kamu mau retur, tapi kamu tetap adalah customer setia kami :(
				</h2>
			</div>
		</div>
	</div>
</div> <!-- kelar Main -->
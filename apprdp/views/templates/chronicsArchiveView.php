<main class="main">
	<div class="content">
		<div class="archive">
			<h2><?= $mainTitle; ?></h2>
			<?php if ($allChronics != null) { ?>
				<table>
					<?php foreach ($allChronics as $row): ?>
						<tr>
							<td>
								<a href="<?= base_url('culture/chronique/' . $row->chronicId . '/' . $row->chronicSlug); ?>"><?= $row->countryName ?> <?= $row->chronicTitle ?> <?= $row->categoryName ?> Par <?= $row->writerFirstName . '    ' . $row->writerLastName ?></a>
							</td>
							<!-- <td></td>
							<td></td>
							<td></td> -->
						</tr>
					<?php endforeach; ?>
				</table>
			<?php }
			else
			{
				echo "<p>  $noChronics </p>";
			} ?>
		</div>
		<!-- pagination -->
		<?= $this->pagination->create_links(); ?>
		<!-- /pagination -->
	</div>
</main>

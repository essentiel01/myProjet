<main class="main">
	<div class="content">
		<div class="archive">
			<h2><?= $mainTitle; ?></h2>
			<table>
				<?php foreach ($allPosts as $row): ?>
					<tr>
						<td>
							<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>"><?= $row->countryName ?>: <?= $row->postTitle ?> <?= $row->categoryName ?>  Par <?= $row->writerFirstName . '    ' . $row->writerLastName ?></a>
						</td>
						<!-- <td></td>
						<td></td>
						<td></td> -->
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</main>

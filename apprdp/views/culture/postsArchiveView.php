<main>
	<div class="container">
		<h2><?= $mainTitle; ?></h2>
		<div class="">
			<table>
				<?php foreach ($allPosts as $row): ?>
					<tr>
						<td>
							<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>"><?= $row->postTitle ?></a>
						</td>
						<td><?= $row->categoryName ?></td>
						<td><?= $row->countryName ?></td>
						<td><?= $row->writerFirstName . '    ' . $row->writerLastName ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
</main>

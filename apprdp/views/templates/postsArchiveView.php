<main class="main">
	<div class="content">
		<div class="archive">
			<h2><?php if(isset($mainTitle){echo $mainTitle;}) ?></h2>
			<?php if ($allPosts != null) { ?>
				<table>
					<?php foreach ($allPosts as $row): ?>
						<tr>
							<td>
								<a href="<?= base_url('culture/publication/' . $row->postId . '/' . $row->postSlug); ?>"><?= $row->countryName ?>: <?= $row->postTitle ?> <?= $row->categoryName ?>  Par <?= $row->writerFirstName . '    ' . $row->writerLastName ?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			<?php } else {
				echo "<p> $noPosts </p>";
			 } ?>
		</div>
		<!-- pagination -->
		<?= $this->pagination->create_links(); ?>
		<!-- /pagination -->
	</div>
</main>

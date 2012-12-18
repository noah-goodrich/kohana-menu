<?/**
 * Navigation item template for Twitter Bootstrap main navbar
 * Render the output inside div.navbar>div.navbar-inner>.container
 *
 * @author Ando Roots <ando@sqroot.eu>
 */
?>
<ul class="nav">

	<?foreach ($menu->get_items() as $item):

	// Is this a dropdown-menu with sibling links?
	if ($item->has_siblings()):?>

		<li class="dropdown  <?=implode(' ', $item->classes)?>" title="<?=$item->tooltip?>">
			<a href="#"
			   class="dropdown-toggle"
			   data-toggle="dropdown"><?=$item->title?><b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				<?foreach ($item->siblings as $subitem): ?>
				<li>
					<?=(string) $subitem?>
				</li>
				<? endforeach?>
			</ul>
		</li>

		<? else:
		// No, this is a "normal", single-level menu
		?>
		<li class="<?=implode(' ', $item->classes)?>">
			<?=(string) $item?>
		</li>

		<? endif ?>

	<? endforeach?>
</ul>
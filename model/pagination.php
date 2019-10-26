<?php
				$pagination_amount = intval(count($data_jobs) / $item_per_page) + 1;
				$order='?';

					$http = 'http://';	
				for ($i = 1; $i <= $pagination_amount; $i++) { ?>
					<?php
						$pagination_url = $http . $_SERVER['SERVER_NAME'] ;
						$item_class = (!empty($_GET['PAGEN_1']) && $_GET['PAGEN_1'] == $i) ? 'blacksquare active' : 'blacksquare';
						$item_class .= (empty($_GET['PAGEN_1']) && $i == '1') ? ' active' : '';
						$pagination_url .= ($i != '1') ? $order.'PAGEN_1=' . $i : '';
					
					?>
					<li class="page-item"><a <?php if (!empty($_GET['order'])) echo 'rel="nofollow"'; ?> href="<?=$pagination_url?>" title="<?=$i?>" class="page-link <?=$item_class?>"><?=$i?></a></li>
				<?php } ?>
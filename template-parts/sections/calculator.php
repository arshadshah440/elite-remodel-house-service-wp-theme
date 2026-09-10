<?php
/**
 * Service detail section: Interactive cost calculator.
 *
 * A kitchen-size estimate ($75-$250 per sq. ft., the one figure in the
 * source data that applies uniformly) plus a set of informational project
 * selections. Each selection shows its own reference range from the brief -
 * those ranges are shown for planning context and are not summed into the
 * headline estimate, since the source data does not specify how to combine
 * them without inventing a formula. Hidden entirely unless a title is set.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_title = erh_field( 'calculator_title' );

if ( ! $erh_title ) {
	return;
}

$erh_text = erh_field( 'calculator_text' );
$erh_note = erh_field( 'calculator_note' );

if ( ! $erh_note ) {
	$erh_note = __( 'This calculator provides a planning estimate. Kitchen dimensions, material selections, existing conditions, labor, permits, and construction requirements determine the final project price.', 'elite-remodel-hub' );
}

/**
 * Reference ranges shown under each dropdown, quoted from the project
 * brief. Not added into the headline total - see the file header note.
 */
$erh_fields = array(
	array(
		'name'    => 'scope',
		'label'   => __( 'Project scope', 'elite-remodel-hub' ),
		'options' => array(
			''         => __( 'Select scope', 'elite-remodel-hub' ),
			'minor'    => __( 'Minor', 'elite-remodel-hub' ),
			'major'    => __( 'Major', 'elite-remodel-hub' ),
			'complete' => __( 'Complete', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'minor'    => __( '$10,000 to $20,000 typical range.', 'elite-remodel-hub' ),
			'major'    => __( '$20,000 to $65,000 typical range.', 'elite-remodel-hub' ),
			'complete' => __( '$65,000 to $130,000+ typical range.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'cabinets',
		'label'   => __( 'Cabinets', 'elite-remodel-hub' ),
		'options' => array(
			''            => __( 'Select cabinets', 'elite-remodel-hub' ),
			'keep'        => __( 'Keep Existing', 'elite-remodel-hub' ),
			'reface'      => __( 'Reface', 'elite-remodel-hub' ),
			'stock'       => __( 'Stock', 'elite-remodel-hub' ),
			'semi-custom' => __( 'Semi-Custom', 'elite-remodel-hub' ),
			'custom'      => __( 'Custom', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'keep'        => __( 'No cabinet replacement cost.', 'elite-remodel-hub' ),
			'reface'      => __( 'Keeps existing boxes; updates doors, drawer fronts, finishes, and hardware.', 'elite-remodel-hub' ),
			'stock'       => __( '$100 to $300 per linear ft. Typical installation runs $1,935 to $10,763.', 'elite-remodel-hub' ),
			'semi-custom' => __( 'Falls between stock and custom pricing.', 'elite-remodel-hub' ),
			'custom'      => __( '$500 to $1,200 per linear ft. Large custom projects can reach $30,000+.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'countertops',
		'label'   => __( 'Countertops', 'elite-remodel-hub' ),
		'options' => array(
			''       => __( 'Select countertops', 'elite-remodel-hub' ),
			'keep'   => __( 'Keep Existing', 'elite-remodel-hub' ),
			'quartz' => __( 'Quartz', 'elite-remodel-hub' ),
			'granite' => __( 'Granite', 'elite-remodel-hub' ),
			'marble' => __( 'Marble', 'elite-remodel-hub' ),
			'butcher-block' => __( 'Butcher Block', 'elite-remodel-hub' ),
			'other'  => __( 'Other', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'keep'   => __( 'No countertop replacement cost.', 'elite-remodel-hub' ),
			'quartz' => __( '$25 to $100 per sq. ft. Installation commonly totals $1,900 to $4,500.', 'elite-remodel-hub' ),
			'granite' => __( '$25 to $170 per sq. ft. Installation commonly totals $1,900 to $4,500.', 'elite-remodel-hub' ),
			'marble' => __( '$25 to $220 per sq. ft.', 'elite-remodel-hub' ),
			'butcher-block' => __( '$25 to $65 per sq. ft.', 'elite-remodel-hub' ),
			'other'  => __( 'Varies by material - see the cabinet and countertop tables below.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'appliances',
		'label'   => __( 'Appliances', 'elite-remodel-hub' ),
		'options' => array(
			''          => __( 'Select appliances', 'elite-remodel-hub' ),
			'keep'      => __( 'Keep Existing', 'elite-remodel-hub' ),
			'selected'  => __( 'Replace Selected', 'elite-remodel-hub' ),
			'all'       => __( 'Replace All', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'keep'     => __( 'No appliance replacement cost.', 'elite-remodel-hub' ),
			'selected' => __( 'Adds the cost of the selected equipment only.', 'elite-remodel-hub' ),
			'all'      => __( 'A complete package commonly adds $3,000 to $20,000.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'flooring',
		'label'   => __( 'Flooring', 'elite-remodel-hub' ),
		'options' => array(
			''        => __( 'Select flooring', 'elite-remodel-hub' ),
			'keep'    => __( 'Keep Existing', 'elite-remodel-hub' ),
			'replace' => __( 'Replace', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'keep'    => __( 'No flooring cost.', 'elite-remodel-hub' ),
			'replace' => __( 'Commonly adds $1,000 to $4,000 - about $3 to $22 per sq. ft. installed.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'plumbing',
		'label'   => __( 'Plumbing', 'elite-remodel-hub' ),
		'options' => array(
			''        => __( 'Select plumbing', 'elite-remodel-hub' ),
			'none'    => __( 'No Changes', 'elite-remodel-hub' ),
			'minor'   => __( 'Minor Changes', 'elite-remodel-hub' ),
			'major'   => __( 'Major Relocation', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'none'  => __( 'No plumbing cost.', 'elite-remodel-hub' ),
			'minor' => __( 'General plumbing work commonly runs $200 to $2,000.', 'elite-remodel-hub' ),
			'major' => __( 'Repiping runs about $3 to $10 per linear ft., plus fixture and drainage work.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'electrical',
		'label'   => __( 'Electrical', 'elite-remodel-hub' ),
		'options' => array(
			''      => __( 'Select electrical', 'elite-remodel-hub' ),
			'none'  => __( 'No Changes', 'elite-remodel-hub' ),
			'minor' => __( 'Minor Changes', 'elite-remodel-hub' ),
			'major' => __( 'Major Changes', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'none'  => __( 'No electrical cost.', 'elite-remodel-hub' ),
			'minor' => __( 'Commonly adds $500 to $2,000.', 'elite-remodel-hub' ),
			'major' => __( 'Extensive upgrades can push costs higher - a project assessment is recommended.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'island',
		'label'   => __( 'Kitchen Island', 'elite-remodel-hub' ),
		'options' => array(
			''       => __( 'Select island', 'elite-remodel-hub' ),
			'none'   => __( 'None', 'elite-remodel-hub' ),
			'update' => __( 'Update Existing', 'elite-remodel-hub' ),
			'add'    => __( 'Add New', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'none'   => __( 'No island cost.', 'elite-remodel-hub' ),
			'update' => __( 'Varies by the features updated - see the island cost table below.', 'elite-remodel-hub' ),
			'add'    => __( 'Cabinets typically run $100 to $1,300 per linear ft., plus any selected features.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'layout',
		'label'   => __( 'Layout', 'elite-remodel-hub' ),
		'options' => array(
			''         => __( 'Select layout', 'elite-remodel-hub' ),
			'keep'     => __( 'Keep Existing', 'elite-remodel-hub' ),
			'moderate' => __( 'Moderate Changes', 'elite-remodel-hub' ),
			'major'    => __( 'Major Changes', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'keep'     => __( 'Major cabinets, appliances, sinks, and walls stay in place.', 'elite-remodel-hub' ),
			'moderate' => __( 'Selected cabinets or appliances change locations without major structural work.', 'elite-remodel-hub' ),
			'major'    => __( 'Can involve wall modifications - a project assessment is recommended.', 'elite-remodel-hub' ),
		),
	),
	array(
		'name'    => 'location',
		'label'   => __( 'Location', 'elite-remodel-hub' ),
		'options' => array(
			''           => __( 'Select state', 'elite-remodel-hub' ),
			'california' => __( 'California', 'elite-remodel-hub' ),
			'oregon'     => __( 'Oregon', 'elite-remodel-hub' ),
			'florida'    => __( 'Florida', 'elite-remodel-hub' ),
			'washington' => __( 'Washington', 'elite-remodel-hub' ),
		),
		'notes'   => array(
			'california' => __( 'Location affects labor and material costs - a project-specific estimate reflects the property location.', 'elite-remodel-hub' ),
			'oregon'     => __( 'Location affects labor and material costs - a project-specific estimate reflects the property location.', 'elite-remodel-hub' ),
			'florida'    => __( 'Location affects labor and material costs - a project-specific estimate reflects the property location.', 'elite-remodel-hub' ),
			'washington' => __( 'Location affects labor and material costs - a project-specific estimate reflects the property location.', 'elite-remodel-hub' ),
		),
	),
);
?>
<section class="erh-calculator erh-section" id="calculator">
	<div class="erh-container erh-container--narrow">

		<div class="erh-section-head">
			<?php erh_split_heading( $erh_title, 0, 'h2' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<div class="erh-calculator__panel" data-erh-calculator>

			<div class="erh-calculator__field erh-calculator__field--size">
				<label for="erh-calc-size"><?php esc_html_e( 'Kitchen size (sq. ft.)', 'elite-remodel-hub' ); ?></label>
				<input type="number" id="erh-calc-size" min="0" step="1" inputmode="numeric" placeholder="<?php esc_attr_e( 'e.g. 120', 'elite-remodel-hub' ); ?>" data-erh-calc-size>
			</div>

			<div class="erh-calculator__grid">
				<?php foreach ( $erh_fields as $erh_field_def ) : ?>
					<div class="erh-calculator__field">
						<label for="erh-calc-<?php echo esc_attr( $erh_field_def['name'] ); ?>"><?php echo esc_html( $erh_field_def['label'] ); ?></label>
						<select id="erh-calc-<?php echo esc_attr( $erh_field_def['name'] ); ?>" data-erh-calc-select data-erh-calc-notes="<?php echo esc_attr( wp_json_encode( $erh_field_def['notes'] ) ); ?>">
							<?php foreach ( $erh_field_def['options'] as $erh_value => $erh_label ) : ?>
								<option value="<?php echo esc_attr( $erh_value ); ?>"><?php echo esc_html( $erh_label ); ?></option>
							<?php endforeach; ?>
						</select>
						<p class="erh-calculator__note" data-erh-calc-note></p>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="erh-calculator__result">
				<span class="erh-calculator__result-label"><?php esc_html_e( 'Your Estimated Kitchen Remodel Cost', 'elite-remodel-hub' ); ?></span>
				<span class="erh-calculator__result-value" data-erh-calc-result><?php esc_html_e( 'Enter your kitchen size to see an estimate', 'elite-remodel-hub' ); ?></span>
			</div>

			<p class="erh-calculator__disclaimer"><?php echo esc_html( $erh_note ); ?></p>

		</div>

	</div>
</section>

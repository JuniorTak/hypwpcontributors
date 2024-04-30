<?php
/**
 * Class Test_Hyp_Contributors
 *
 * @package HypContributors
 */

/**
 * Hyp Contributors test case.
 */
class Test_Hyp_Contributors extends WP_UnitTestCase {

	/**
	 * The post id
	 *
	 * @var int
	 */
	private $post_id;

	/**
	 * The setUp function.
	 */
	public function setUp() {
		parent::setUp();

		// Create a new post for our simulations.
		$this->post_id = $this->factory->post->create();
	}

	/**
	 * The tearDown function.
	 */
	public function tearDown() {
		wp_delete_post( $this->post_id, true );
		parent::tearDown();
	}

	/**
	 * Contributors metabox test.
	 */
	public function test_hyp4rt_contributors_metabox() {
		global $wp_meta_boxes;

		// Execute the function that registers the metabox.
		hyp4rt_contributors_metabox();

		// Check if the metabox is correctly added.
		$this->assertArrayHasKey( 'hyp4rt_contributors_metabox', $wp_meta_boxes['post']['side']['default'] );
	}

	/**
	 * Metabox content test.
	 */
	public function test_hyp4rt_metabox_content() {
		$post = get_post( $this->post_id );

		// Simulate the action to add metaboxes.
		do_action( 'add_meta_boxes', 'post', $post );

		// Capture the metabox output.
		ob_start();
		hyp4rt_metabox_content( $post );
		$output = ob_get_clean();

		// Check if the output contains a checkbox input.
		$this->assertStringContainsString( '<input type="checkbox"', $output );
	}

	/**
	 * Save metabox data test.
	 */
	public function test_hyp4rt_save_metabox_data() {}

	/**
	 * Display contributors test.
	 */
	public function test_hyp4rt_display_contributors() {}
}

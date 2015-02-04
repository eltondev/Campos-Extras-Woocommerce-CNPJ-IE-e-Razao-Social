/**
 *
 * Elton Pereira - eltondeveloper@gmail.com
 *
 * @retrun void.
 */
 
 function wooc_campos_extra_registro() {
        ?>
        <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e( 'Nome do responsável', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
        </p>
       
        <p class="form-row form-row-last">
        <label for="reg_billing_company"><?php _e( 'Razão sosial', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_company" id="reg_billing_company" value="<?php if ( ! empty( $_POST['billing_company'] ) ) esc_attr_e( $_POST['billing_company'] ); ?>" />
        </p>
 
        <div class="clear"></div>
 
        <p class="form-row form-row-wide">
        <label for="reg_billing_cnpj"><?php _e( 'CNPJ', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" placeholder="000.000.000/0000-00" class="input-text" name="billing_cnpj" id="reg_billing_cnpj" value="<?php if ( ! empty( $_POST['billing_cnpj'] ) ) esc_attr_e( $_POST['billing_cnpj'] ); ?>" />
        </p>
 
        <p class="form-row form-row-wide">
        <label for="reg_billing_ie"><?php _e( 'Inscrição estadual,', 'woocommerce' ); ?> <span></span></label>
        <input type="text" class="input-text" name="billing_ie" id="reg_billing_ie" value="<?php if ( ! empty( $_POST['billing_ie'] ) ) esc_attr_e( $_POST['billing_ie'] ); ?>" />
        </p>
 
        <?php
}
add_action( 'woocommerce_register_form_start', 'wooc_campos_extra_registro' );
 
/**
 * Validar os campos de registro extra.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
function wooc_validar_campos_extra_registro( $username, $email, $validation_errors ) {
        if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
                $validation_errors->add( 'billing_first_name_error', __( '<strong>Erro!</strong>: Informe o nome do responsável!', 'woocommerce' ) );
        }
        if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) ) {
                $validation_errors->add( 'billing_company', __( '<strong>Erro!</strong>: Informe a razão social!.', 'woocommerce' ) );
        }              
        if ( isset( $_POST['billing_ie'] ) && empty( $_POST['billing_ie'] ) ) {
                $validation_errors->add( 'billing_ie', __( '<strong>Erro!</strong>: Informe a inscrição estadual!', 'woocommerce' ) );
        }
        if ( isset( $_POST['billing_cnpj'] ) && empty( $_POST['billing_cnpj'] ) ) {
                $validation_errors->add( 'billing_cnpj_error', __( '<strong>Erro!</strong>: Informe o CNPJ!.', 'woocommerce' ) );              
        }
}
add_action( 'woocommerce_register_post', 'wooc_validar_campos_extra_registro', 10, 3 );
 
/**
 * Salvar campos extras.
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function wooc_salvar_campos_extra_registro( $customer_id ) {
        if ( isset( $_POST['billing_first_name'] ) ) {
                // WordPress default para o campo primeiro nome.
                update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
                // WooCommerce primeiro nome.
                update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        }
        if ( isset( $_POST['billing_company'] ) ) {
                // WooCommerce Empresa
                update_user_meta( $customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );
        }
        if ( isset( $_POST['billing_ie'] ) ) {
                // WooCommerce ie
                update_user_meta( $customer_id, 'billing_ie', sanitize_text_field( $_POST['billing_ie'] ) );
        }
 
        if ( isset( $_POST['billing_cnpj'] ) ) {
                // WooCommerce cnpj
                update_user_meta( $customer_id, 'billing_cnpj', sanitize_text_field( $_POST['billing_cnpj'] ) );
        }
}
add_action( 'woocommerce_created_customer', 'wooc_salvar_campos_extra_registro' );

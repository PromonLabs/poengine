<div id="order-flow" class="data expand-table">
	<div class="contents">
		<h2 class="align-center">Order Flow</h2>
		<!-- Order section -->
		<div id="order-section" class="side-by-side grey-border">
			<div class="panel">
				<h3 style="margin-top: 0">Order</h3>
				<div class="panel-body">
						<table border="1">
							<tbody>
								<tr>
									<th>Created</th>
									<td>29.11.18 11:44:04</td>
								</tr>
								<tr>
									<th>Updated</th>
									<td>29.11.18 12:39:55</td>
								</tr>
								<tr>
									<th>Options</th>
									<td>
										<!-- Show order XML button -->

										<form action="/crm/order/show-xml" method="GET" class="buttons">
	                                    	<input type="hidden" name="orderId" value="512875" />
	                                      	<button type="button" class="open-wizard button show-order-xml small-button" >
			                                    Show XML
			                                </button>
	                                	</form>

										<!-- Update Order Preferred Date button -->
										<form action="/crm/orderlog-wizard/orderlog-update" method="GET" class="buttons">
	                                    	<input type="hidden" name="orderId" value="512875" />
	                                    	<input type="hidden" name="date" value="29.11.2018" />


													<button type="button" class="open-wizard button update-preferred-date small-button" disabled>
			                                        	Update preferred date
			                                    	</button>



	                                	</form>
	                                	<!-- Enable edit Order Note button -->

		   									<button type="button" class="edit-order-note-btn small-button">
				                                Edit note
				                            </button>

	                                    <!-- Retry Order button -->

		                                	<form action="/crm/order/orderlog-retry" method="POST">
											<input type="hidden" name="orderId" value="512875" />
											<input type="hidden" name="orderStatus" value="complete" />



											    <button type="button" class="retry-order-btn small-button" disabled>
			                                    	Retry
			                                    </button>



		                                    </form>

    									<!-- Abort Order button -->

	                                    	<form action="/crm/order/orderlog-abort" method="POST">
												<input type="hidden" name="orderId" value="512875" />
												<input type="hidden" name="orderStatus" value="complete" />


												     <button type="button" class="abort-order-btn small-button" disabled>
				                               			Abort
				                                	</button>



			                           		</form>
			                           		<span id="order-abort-warning-message" class="hidden">Are you sure that you want to cancel Order No. 512875?</span>
			                           		<span id="order-abort-warning-confirmation" class="hidden">Yes</span>
			                           		<span id="order-abort-error-message" class="hidden">Order Abort failed in OSS for Order No. 512875</span>
											<span id="order-abort-error-information" class="hidden">Ok</span>

									</td>
								</tr>
							</tbody>
						</table>
						<table border="1">
							<tr>
								<th style="width:15%;">Note</th>
								<td  id="note-field-container">
									<div id="note-field">
										<!-- textarea tag has to be in-line otherwise produces white spaces  -->
										<textarea class="note-textarea" disabled> </textarea>
									</div>
									<!-- Update Order Note button -->
				                    <form action="/crm/order/update-note" id="order-update-note" method="POST">
										<input type="hidden" name="orderId" value="512875" />


										<button type="button" class="cancel-edit-order-note-btn small-button hidden" >
							            	Cancel
							            </button>
										<button type="button" class="update-order-note-btn small-button hidden" >
							            	Update
							            </button>

	                            	</form>
								</td>
							</tr>
						</table>
			    </div>
			</div>
	    </div>

	    <div class="side-by-side middle"></div>
	    <!-- Steps section -->
	    <div id="steps-section" class="side-by-side grey-border">
	    	<div class="panel">
	    		<h3 style="margin-top: 0">Steps</h3>
	    		<div class="panel-body">
					    <table id="steps-table-512875" class="fwd-rules tablesorter" style="white-space:nowrap" border="1" >
					    	<thead>
								<tr>
									<th>Sequence</th>
									<th>Action</th>
									<th>Status</th>
									<th>Options</th>
								</tr>
							</thead>

							<tbody>



















								<tr>
									<input class="action-instance-index" type="hidden" value="0" />

									<td>1</td>
									<td>updateMobileServiceBs</td>
									<td class="status-completed step-status-cell" data-step-message="Callback received">completed</td>
									<td>
										<form action="/crm/order/orderlog-skip-step" method="POST">
											<input type="hidden" name="orderId" value="512875" />
											<input type="hidden" name="orderStatus" value="complete" />
											<input type="hidden" name="stepStatus" value="completed" />
											<input type="hidden" name="stepName" value="updateMobileServiceBs" />






					                                    <button type="button" class="skip-order-step-btn small-button" disabled>
					                                    	Skip
					                                    </button>





	                                    </form>
									</td>
								</tr>


















								<tr>
									<input class="action-instance-index" type="hidden" value="1" />

									<td>2</td>
									<td>updateBalanceTusass</td>
									<td class="status-completed step-status-cell" data-step-message="Action completed successfully">completed</td>
									<td>
										<form action="/crm/order/orderlog-skip-step" method="POST">
											<input type="hidden" name="orderId" value="512875" />
											<input type="hidden" name="orderStatus" value="complete" />
											<input type="hidden" name="stepStatus" value="completed" />
											<input type="hidden" name="stepName" value="updateBalanceTusass" />






					                                    <button type="button" class="skip-order-step-btn small-button" disabled>
					                                    	Skip
					                                    </button>





	                                    </form>
									</td>
								</tr>


















								<tr>
									<input class="action-instance-index" type="hidden" value="2" />

									<td>3</td>
									<td>modifyServiceInformationV2</td>
									<td class="status-completed step-status-cell" data-step-message="Action completed successfully">completed</td>
									<td>
										<form action="/crm/order/orderlog-skip-step" method="POST">
											<input type="hidden" name="orderId" value="512875" />
											<input type="hidden" name="orderStatus" value="complete" />
											<input type="hidden" name="stepStatus" value="completed" />
											<input type="hidden" name="stepName" value="modifyServiceInformationV2" />






					                                    <button type="button" class="skip-order-step-btn small-button" disabled>
					                                    	Skip
					                                    </button>





	                                    </form>
									</td>
								</tr>


















								<tr>
									<input class="action-instance-index" type="hidden" value="3" />

									<td>4</td>
									<td>createAddonBilling</td>
									<td class="status-completed step-status-cell" data-step-message="Action completed successfully">completed</td>
									<td>
										<form action="/crm/order/orderlog-skip-step" method="POST">
											<input type="hidden" name="orderId" value="512875" />
											<input type="hidden" name="orderStatus" value="complete" />
											<input type="hidden" name="stepStatus" value="completed" />
											<input type="hidden" name="stepName" value="createAddonBilling" />






					                                    <button type="button" class="skip-order-step-btn small-button" disabled>
					                                    	Skip
					                                    </button>





	                                    </form>
									</td>
								</tr>


















								<tr>
									<input class="action-instance-index" type="hidden" value="4" />

									<td>5</td>
									<td>sendSmsNotification</td>
									<td class="status-completed step-status-cell" data-step-message="Action completed successfully">completed</td>
									<td>
										<form action="/crm/order/orderlog-skip-step" method="POST">
											<input type="hidden" name="orderId" value="512875" />
											<input type="hidden" name="orderStatus" value="complete" />
											<input type="hidden" name="stepStatus" value="completed" />
											<input type="hidden" name="stepName" value="sendSmsNotification" />






					                                    <button type="button" class="skip-order-step-btn small-button" disabled>
					                                    	Skip
					                                    </button>





	                                    </form>
									</td>
								</tr>


















								<tr>
									<input class="action-instance-index" type="hidden" value="5" />

									<td>6</td>
									<td>tsMFOrderCompletedCallback</td>
									<td class="status-completed step-status-cell" data-step-message="Action completed successfully">completed</td>
									<td>
										<form action="/crm/order/orderlog-skip-step" method="POST">
											<input type="hidden" name="orderId" value="512875" />
											<input type="hidden" name="orderStatus" value="complete" />
											<input type="hidden" name="stepStatus" value="completed" />
											<input type="hidden" name="stepName" value="tsMFOrderCompletedCallback" />







												  		&nbsp;




	                                    </form>
									</td>
								</tr>


							</tbody>
					    </table>
	    		</div>
	    	</div>
	    </div>
	</div>

	<div id="bottom-content" class="contents">
		<!-- Offer section -->
		<div id="offer-section" class="side-by-side grey-border" >
			<div class="panel">
			    <h3 style="margin-top: 0">Offer</h3>
			    <div class="panel-body">

			    		<table class="fwd-rules tablesorter"  border="1">
				    		<thead>
				    			<tr>
				    				<th>ID</th>
				    				<th>Primary offer</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			<tr>
				    			    <td>897</td>
				    				<td>Tusass Mobil First</td>
				    			</tr>
				    		</tbody>
				    	</table>



				    	<table class="fwd-rules tablesorter" border="1">
				    		<thead>
				    			<tr>
				    				<th>ID</th>
				    				<th>Addons</th>
				    			</tr>
				    		</thead>
				    		<tbody>

					    			<tr>
					    				<td>900</td>
					    				<td>Tusass internet MF 30 Mbit</td>
					    			</tr>

				    		</tbody>
				    	</table>


			    </div>
			  </div>
		  </div>
		  <div class="side-by-side middle"></div>

		 <!-- Bridge Server section -->
		 <div id="bridge-server-section" class="side-by-side grey-border" >
			 <div class="panel">
			    <h3 style="margin-top: 0">Bridge Server</h3>
			    <div id="bridge-server-panel-body" class="panel-body">


			    		<div class="notice-large">
							<button id="get-oss-wf-btn"  type="button" class="" data-url="/crm/order/512875/oss-workflow" >OSS Workflow</button>
						</div>


			    </div>
			  </div>
		  </div>
	  </div>
</div>

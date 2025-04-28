<style>
	.step-header {
			padding-bottom: 10px;
			margin-bottom: 10px;
      position: relative;
	}
	.step-list {
      position: relative;
			display: flex;
			flex-direction: row;
			justify-content: space-around;
      z-index: 1;
	}
	.step-header-number{
			display: -ms-inline-flexbox;
			display: inline-flex;
			-ms-flex-line-pack: center;
			align-content: center;
			-ms-flex-pack: center;
			justify-content: center;
			width: 3em;
			height: 3em;
			padding: 0.5em 0;
			margin: 0.25rem;
			line-height: 1em;
			color: #fff;
			font-weight: 500;
			background-color: #6c757d;
			border-radius: 4em;
			padding-top: 25px;
			font-size: 1.5em;
	}

	.step-button{
			text-align: center;
			padding: 0px 50px;
	}

	.step-header-number.active{
			color: #fff;
			background-color: #016004;
	}

	.step-header-title{
			text-align: center;
	}

	.flatpickr-wrapper{
			width: 100% !important
	}

	.logo_image_picker{
			border-radius: 0.4rem !important;
			border: 1.5px dotted #dee2e6;
	}

	.image-hover-handler{
			transition: 0.5s;
	}
	.logo_image_picker:hover{
			.wrap_logo_image_picker{
			transform: scale(0.95)
			}

			.image-hover-handler{
			transform: scale(0.95)
			}
	}

	.wrap_logo_image_picker{
			transition: 0.5s;
	}

		/* Hide the radio buttons */
	.card-radio input[type="radio"] {
		display: none;
	}

	/* Style the card */
	.card-radio .card {
		cursor: pointer;
		transition: transform 0.2s ease-in, box-shadow 0.2s ease-in;
	}

	/* Highlight the selected card */
	.card-radio input[type="radio"]:checked + .card {
		border: 4px solid #007bff;
		box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
		transform: scale(1);
	}

  .progress {
    position: absolute;
    top: 40%;
    left: 0;
    width: 100%;
    height: 4px;
    background-color: #e0e0e0;
    z-index: 0;
    transform: translateY(-50%);
  }

  .progress-bar {
    height: 100%;
    background-color: #016004; /* Bootstrap primary blue */
    z-index: 0;
  }
</style>
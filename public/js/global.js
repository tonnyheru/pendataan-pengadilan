class Ryuna {
    static modal(params) {
        let { title, body, footer } = params;

        $("#myModal #modal_title").html("");
        $("#myModal #modal_body").html("");
        $("#myModal #modal_footer").html("");

        $("#myModal #modal_title").html(title);
        $("#myModal #modal_body").html(body);
        $("#myModal #modal_footer").html(footer);
        $("#myModal").modal("show");
    }

    static close_modal() {
        $("#myModal").modal("hide");
    }

    static large_modal() {
        $("#myModal .modal-dialog").removeClass("modal-lg");
        $("#myModal .modal-dialog").addClass("modal-xl");
        $("#myModal .modal-dialog").on(
            "click",
            '[data-dismiss="modal"]',
            function () {
                // $("#myModal .modal-dialog").removeClass("modal-xl");
            }
        );
    }

    static small_modal() {
        $("#myModal .modal-dialog").removeClass("modal-lg");
        $("#myModal .modal-dialog").addClass("modal-sm");
        $("#myModal .modal-dialog").on(
            "click",
            '[data-dismiss="modal"]',
            function () {
                // $("#myModal .modal-dialog").removeClass("modal-xl");
            }
        );
    }

    static blockUI(message) {
        $.blockUI({
            message:
                '<span class="text-semibold"><img src="' +
                base_url +
                "img/loading2.gif" +
                '" style="height: 21px;">' +
                (message ? message : " Please Wait") +
                "</span>",
            baseZ: 10000,
            overlayCSS: {
                backgroundColor: "rgba(0, 0, 0, 0.17)",
                opacity: 1,
                cursor: "wait",
                "backdrop-filter": "blur(2px)",
            },
            css: {
                "z-index": 10020,
                padding: "10px 5px",
                margin: "0px",
                width: "20%",
                top: "40%",
                left: "40%",
                "text-align": "center",
                color: "rgba(82, 95, 127, 1)",
                border: "0px",
                "background-color": "rgb(255, 255, 255)",
                cursor: "wait",
                "border-radius": "10px",
                // 'border': '2px rgba(82, 95, 127, 1) solid',
                "font-size": "16px",
                "min-width": "95px",
            },
        });
    }

    static progressLoading(percent = 0) {
        $.blockUI({
            message: `<div class="progress-wrapper">
                <div class="progress-info">
                  <div class="progress-percentage">
                    <span>Proses Upload: ${percent}%</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="${percent}" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                </div>
                <button id="cancelBtn" style="display:none; margin-top: 10px;" class="btn btn-danger">Cancel</button>
              </div>`,
            baseZ: 10000,
            overlayCSS: {
                backgroundColor: "rgba(0, 0, 0, 0.17)",
                opacity: 1,
                cursor: "wait",
                "backdrop-filter": "blur(2px)",
            },
            css: {
                "z-index": 10020,
                padding: "10px 20px",
                margin: "0px",
                width: "50%",
                top: "40%",
                left: "25%",
                "text-align": "center",
                color: "rgba(82, 95, 127, 1)",
                border: "0px",
                "background-color": "rgb(255, 255, 255)",
                cursor: "wait",
                "border-radius": "10px",
                "font-size": "16px",
                "min-width": "95px",
            },
        });

        // Show cancel button after 5 seconds
        timeoutID = setTimeout(function () {
            $("#cancelBtn").show();
        }, 5000);

        // Add event listener for cancel button
        $("#cancelBtn").click(function () {
            if (xhr) {
                xhr.abort(); // Cancel the upload
                $.unblockUI(); // Hide the overlay
                alert("Upload canceled!");
            }
        });
    }

    static blockElement(element, message) {
        $(element).block({
            message:
                '<span class="text-semibold"><img src="' +
                base_url +
                "img/loading2.gif" +
                '" style="height: 21px;">' +
                (message ? message : " Please Wait") +
                "</span>",
            baseZ: 10000,
            overlayCSS: {
                backgroundColor: "rgba(0, 0, 0, 0.1)",
                opacity: 1,
                cursor: "wait",
                "backdrop-filter": "blur(0.5px)",
                "border-radius": ".4375rem",
            },
            css: {
                "z-index": 10020,
                padding: "10px 5px",
                margin: "0px",
                width: "20%",
                top: "40%",
                left: "40%",
                "text-align": "center",
                color: "rgba(82, 95, 127, 1)",
                border: "0px",
                "background-color": "rgb(255, 255, 255)",
                cursor: "wait",
                "border-radius": ".4375rem",
                // 'border': '2px rgba(82, 95, 127, 1) solid',
                "font-size": "16px",
                "min-width": "95px",
            },
        });
    }

    static unblockUI() {
        $.unblockUI();
    }

    static unblockElement(element) {
        $(element).unblock();
    }

    static input_nominal(element) {
        return new AutoNumeric(element, {
            decimalCharacter: ",",
            digitGroupSeparator: ".",
            emptyInputBehavior: "min",
            minimumValue: "0",
        });
    }

    static input_nominal_multiple(element) {
        new AutoNumeric.multiple(element, {
            decimalCharacter: ",",
            digitGroupSeparator: ".",
            emptyInputBehavior: "min",
            minimumValue: "0",
        });
    }

    static input_percent(element) {
        new AutoNumeric(element, {
            decimalCharacter: ",",
            digitGroupSeparator: ".",
            emptyInputBehavior: "min",
            minimumValue: "0",
            maximumValue: "100",
        });
    }

    static input_percent_multiple(element) {
        new AutoNumeric.multiple(element, {
            decimalCharacter: ",",
            digitGroupSeparator: ".",
            emptyInputBehavior: "min",
            minimumValue: "0",
            maximumValue: "100",
        });
    }

    static input_number_fixed(element) {
        return new AutoNumeric(element, {
            decimalCharacter: ",",
            digitGroupSeparator: ".",
            emptyInputBehavior: "min",
            minimumValue: "0",
            decimalPlaces: "0",
            decimalPlacesRawValue: "0",
        });
    }

    static format_nominal(nominal) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
        }).format(nominal);
    }

    static format_percent(nominal) {
        return (
            new Intl.NumberFormat("id-ID", { currency: "IDR" }).format(
                nominal
            ) + " %"
        );
    }

    static decimal(nominal = 0, decimals = 2) {
        // Pastikan nominal adalah angka
        nominal = parseFloat(nominal);

        if (isNaN(nominal)) {
            nominal = 0;
        }

        // Format angka dengan jumlah desimal yang diinginkan
        let formatted = nominal.toFixed(decimals).replace(".", ",");

        // Tambahkan pemisah ribuan
        let parts = formatted.split(",");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Pemisah ribuan

        // Gabungkan kembali angka dan desimal
        let result = parts[0] + "," + parts[1];

        // Sisipkan desimal dalam elemen <small>
        return parts[0] + "<small>," + parts[1] + "</small>";
    }

    static rstatus(data) {
        data = +data;
        let html = "";
        switch (data) {
            case 0:
                html =
                    '<span class="badge text-white bg-danger">inactive</span>';
                break;
            case 1:
                html =
                    '<span class="badge text-white bg-success">active</span>';
                break;
            case 2:
                html =
                    '<span class="badge text-white bg-yellow">need approval</span>';
                break;
            case 3:
                html = '<span class="badge text-white bg-danger">reject</span>';
                break;
            case 4:
                html =
                    '<span class="badge text-white bg-danger">expired</span>';
                break;
            default:
                html = '<span class="badge text-white bg-secondary"></span>';
                break;
        }
        return html;
    }

    static rstatus_approval(data, type) {
        // console.log(type)
        data = +data;
        let html = "";
        type = type || "product";
        // console.log(data)
        switch (data) {
            case 1:
                html =
                    '<span class="badge text-white bg-primary">approval create</span>';
                break;
            case 2:
                html =
                    '<span class="badge text-white bg-primary">approval update</span>';
                break;
            case 3:
                html =
                    '<span class="badge text-white bg-primary">approval delete</span>';
                break;
            case 4:
                html =
                    '<span class="badge text-white bg-primary">approval soft delete</span>';
                break;
            case 5:
                html =
                    '<span class="badge text-white bg-primary">approval restore</span>';
                break;
            case 6:
                var label = "";
                switch (type) {
                    case "product":
                        label = "fee";
                        break;
                    case "mitra":
                        label = "product";
                        break;
                    case "virtual_account":
                        label = "suspend";
                        break;
                    default:
                        label = "";
                        break;
                }
                html = `<span class="badge text-white bg-primary">approval ${label}</span>`;
                break;
            case 7:
                var label = "";
                switch (type) {
                    case "product":
                        label = "config";
                        break;
                    case "mitra":
                        label = "fee";
                        break;
                    case "virtual_account":
                        label = "unsuspend";
                        break;
                    default:
                        label = "";
                        break;
                }
                html = `<span class="badge text-white bg-primary">approval ${label}</span>`;
                break;
            case 8:
                var label = "";
                switch (type) {
                    case "mitra":
                        label = "user";
                        break;
                    default:
                        label = "user";
                        break;
                }
                html = `<span class="badge text-white bg-primary">approval ${label}</span>`;
                break;
            case 9:
                html = `<span class="badge text-white bg-primary">approval status</span>`;
                break;
            default:
                html = '<span class="badge text-white bg-secondary"></span>';
                break;
        }

        return html;
    }

    static rproduct_type(data) {
        let html = "";
        if (data == "disbursement") {
            html = `<span class="badge badge-success"><i class="fas fa-chevron-down"></i> ${data}</span>`;
        } else if (data == "general") {
            html = `NORMAL`;
        } else {
            html = `<span class="badge badge-danger"><i class="fas fa-chevron-up"></i> ${data.replace(
                "_",
                " "
            )}</span>`;
        }
        return html;
    }

    static rstatus_enable(data) {
        data = +data;
        let html = "";
        if (data == 1) {
            html = `<span class="badge badge-success">enabled</span>`;
        } else {
            html = `<span class="badge badge-danger">disabled</span>`;
        }
        return html;
    }

    static rstatus_transaction(data) {
        data = +data;
        let html = "";
        if (data == 0) {
            html = "<span class='badge badge-warning'>MENUNGGU</span>";
        } else if (data == 1) {
            html = "<span class='badge badge-primary'>BERJALAN</span>";
        } else if (data == 2) {
            html = "<span class='badge badge-success'>BERHASIL</span>";
        } else if (data == 3) {
            html = "<span class='badge badge-danger'>GAGAL</span>";
        }

        return html;
    }

    static rstatus_transfer(data) {
        data = +data;
        let html = "";
        switch (data) {
            case 0:
                html =
                    '<span class="badge text-white bg-warning">pending</span>';
                break;
            case 1:
                html =
                    '<span class="badge text-white bg-success">success</span>';
                break;
            case 2:
                html = '<span class="badge text-white bg-danger">failed</span>';
                break;
            default:
                html = '<span class="badge text-white bg-secondary"></span>';
                break;
        }
        return html;
    }

    static leftpad(num, targetLength) {
        return String(num).padStart(targetLength, "0");
    }

    static noty(type, title, message) {
        title = title && title != null ? `<strong>${title}</strong><br>` : "";
        new Noty({
            type: type,
            theme: "mint",
            timeout: 6000,
            progressBar: true,
            text: `${title}${message}`,
        }).show();
    }

    static summernote(element) {
        return $(element).summernote({
            placeholder: "Ketik Sesuatu",
            tabsize: 2,
            height: 100,
        });
    }

    static isEmail(email) {
        let regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return regex.test(email);
    }

    static isUsernameValid(username) {
        // username is alphanumeric, underscore, dot, and dash
        let first_rule = /^[a-zA-Z0-9._-]+$/;

        // username is not start with underscore, dot, and dash
        // username is not end with underscore, dot, and dash
        let second_rule = /^[a-zA-Z0-9]+[a-zA-Z0-9._-]*[a-zA-Z0-9]+$/;

        // underscore, dot, and dash is not repeated more than 1 time
        // underscore, dot, and dash is not side by side
        let third_rule = /([._-])[._-]/;

        // username length is 5-20
        let fourth_rule = /^.{5,20}$/;

        return {
            first_rule: first_rule.test(username),
            second_rule: second_rule.test(username),
            third_rule: !third_rule.test(username),
            fourth_rule: fourth_rule.test(username),
        };
    }

    static helpModal(key) {
        Ryuna.blockUI();
        const version = "v1";
        let url = base_url + "admin/wiki_content/help/" + version + "/" + key;
        $.get(url)
            .done((res) => {
                Ryuna.large_modal();
                Ryuna.modal({
                    title: res?.title,
                    body: res?.body,
                    footer: res?.footer,
                });

                Ryuna.unblockUI();
            })
            .fail((xhr) => {
                console.log(xhr);
                Ryuna.unblockUI();
            });
    }

    static requestTimeout(fn, timems) {
        let time;
        function clear_requestTimeout() {
            clearTimeout(time);
        }
        let request = fn(clear_requestTimeout);
        time = setTimeout(() => {
            request.abort();
            Ryuna.unblockUI();
            Swal.fire({
                title: "Whoops!",
                text: "Request Timeout",
                type: "error",
                confirmButtonColor: "#007bff",
            });
        }, timems);
    }

    static tableToString(id) {
        const table = document.getElementById(id).outerHTML;
        const parser = new DOMParser();
        const doc = parser.parseFromString(table, "text/html");
        doc.querySelector(".xls-ignore")?.remove();
        doc.querySelectorAll(".row-ignore").forEach((e) => e.remove());
        if ("." === ".") {
            doc.querySelectorAll(".digit").forEach((span) => {
                const text = span.textContent
                    ?.replaceAll(".", "")
                    .replaceAll(",", ".");
                span.textContent = text;
            });
        }
        return doc.getElementById(id)?.outerHTML;
    }
}

class Stepper {
    position = 1;
    max_step = 3;

    constructor(props) {
        let { max_step } = props;
        if (max_step) {
            this.max_step = max_step;
        }
    }

    prev() {
        if (this.position > 1) {
            this.position--;
        }
    }

    next() {
        if (this.position < this.max_step) {
            this.position++;
        }
    }
}

class Doom {
    static createElement(tag, prop = {}) {
        let $__el = document.createElement(tag);

        if (prop.attributes) {
            for (let [key, value] of Object.entries(prop.attributes)) {
                if (typeof value === "boolean") {
                    value && $__el.setAttribute(key, value);
                    continue;
                }
                $__el.setAttribute(key, value);
            }
        }

        if (prop.events) {
            for (let [event, callback] of Object.entries(prop.events)) {
                $__el.addEventListener(event, callback);
            }
        }

        for (let child in prop.children) {
            $__el.appendChild(prop.children[child]);
        }

        return $__el;
    }

    static tr(prop = {}) {
        return Doom.createElement("tr", prop);
    }

    static td(prop = {}) {
        return Doom.createElement("td", prop);
    }

    static select(prop = {}) {
        return Doom.createElement("select", prop);
    }

    static input(prop = {}) {
        return Doom.createElement("input", prop);
    }

    static button(prop = {}) {
        return Doom.createElement("button", prop);
    }

    static text(value) {
        return document.createTextNode(value);
    }

    static icon(name) {
        return Doom.createElement("i", {
            attributes: {
                class: name,
            },
        });
    }
}

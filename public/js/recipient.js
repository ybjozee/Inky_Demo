const form = document.getElementById("form");
let recipientCount = document.getElementsByClassName("recipients").length;

const getRecipientFieldJSX = (index) => `
        <div class="col-5">
            <input type="email" class="form-control" placeholder="Enter an email" name="recipients[${index}]" required>
            <div class="invalid-feedback">
                Please provide the recipient's email in a valid format.
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <button class="btn" type="button" onclick="handleAddRecipientButtonClick()">
                    <i class="bi bi-patch-plus text-success" style="font-size: 1.3rem"></i>
                </button>
                <button class="btn" type="button" onclick="deleteRecipientField(${index})">
                    <i class="bi bi-trash3 text-danger" style="font-size: 1.3rem"></i>
                </button>
            </div>
        </div>
`;

const handleAddRecipientButtonClick = () => {
  const div = document.createElement("div");
  div.setAttribute("class", "row g-3 mb-3 recipientInput");
  div.setAttribute("id", `recipient_${recipientCount}`);
  div.innerHTML = getRecipientFieldJSX(recipientCount);
  const lastChild = document.getElementById(`recipient_${recipientCount - 1}`);
  lastChild.after(div);
  recipientCount++;
};

const deleteRecipientField = (index) => {
  const recipient = document.getElementById(`recipient_${index}`);
  recipient.parentNode.removeChild(recipient);
  recipientCount--;
};

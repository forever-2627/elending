let jobTitle = "";
let possibleQuestions = [];
let detailOption = "";
let workingType = "";
const loadingButtonContent = 
`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
Please Wait...`;
let minimumBudget = 0;
let maximumBudget = 0;

const fetchChatGPTResponse = async (prompt)=> {
    
    try {
            const response = await fetch(
            "https://api.openai.com/v1/chat/completions",
            {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer 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`,
                },
                body: JSON.stringify({
                model: 'gpt-3.5-turbo',
                // prompt: prompt,
                messages: [{role: 'user', content: prompt}],
                max_tokens: 1000,
                temperature: 0,
                }),
            });
            console.log(response);
            const data = await response.json();
            console.log(data);
            return data.choices[0].message.content;
        }
    catch (err) {
        console.error(err);
    }
}

const validJobTitle =  () => {
    const title = $('#job_post_title').val();
    if(title === ''){
        toastr.warning('Please input <b>Job Title</b>', 'Input Error');
        return false;
    }
    if(title.length < 10){
        toastr.warning('Please input <b>Job Title</b> more than 10 charaters', 'Input Error');
        return false;
    }
    jobTitle = title;
    return true;
}

const writeAutomatically = () => {
    const isValid = validJobTitle();
    if(isValid){
        const originalContent = $('#auto_writing_button').html();
        $('#auto_writing_button').html(loadingButtonContent);
        // fetchChatGPTResponse(`possible industry 5 options for ${jobTitle}`)
        fetchChatGPTResponse(`I am going to write job description, title is "${jobTitle}". Which question is needed to get detail of this title?`)
        .then(response => { 
            console.log(response);
            const options = response.trim().split('\n');
            for(let i = 0; i < options.length; i++){
                possibleQuestions.push(options[0]);
            }
        });
        $('#job_post_question_one_label').html(possibleQuestions[0]);
        getPossibleOptionsForQuestionOne(possibleQuestions[0]);
    }
}

const getPossibleOptionsForQuestionOne = (question) => {
    
    fetchChatGPTResponse(`possible 10 answers for this question "${question}" "${jobTitle}"`)
        .then(response => { 
            console.log(response);
            // const options = response.trim().split('\n');
            // for(let i = 0; i < options.length; i++){
            //     possibleQuestions.push(options[0]);
            // }
        });
}

// const writeAutomatically = () => {
//     const isValid = validJobTitle();
//     if(isValid){
//         const originalContent = $('#auto_writing_button').html();
//         $('#auto_writing_button').html(loadingButtonContent);
//         // fetchChatGPTResponse(`possible industry 5 options for ${jobTitle}`)
//         fetchChatGPTResponse(`I am going to write job description, title is "${jobTitle}". Which question is needed to get detail of this title?`)
//         .then(response => { 
//             console.log(response);
//             const options = response.trim().split('\n');
//             let industryOptions = [];
//             for(let i = 0; i < options.length; i++){
//                 possibleQuestions.push(options[0]);
//             }
//             renderIndustryOptions(industryOptions);
//             $('#auto_writing_button').html(originalContent);
//             $('#auto_writing_button').prop('disabled', true);
//         });
        
//     }
// }

const renderIndustryOptions = (options) => {
    let html = '';
    for(let i = 0; i < options.length; i++){
        html += `
            <div class="job-post-option">
                <div>
                    <div class="form-check d-flex align-items-center gap-1">
                        <input class="form-check-input mb-1 job-post-option-checkbox" type="checkbox" option="${options[i]}" id="industry_option_${i}" index="${i}" onchange="handleIndustryOptionChange(this)">
                        <label class="form-check-label" for="job_post_option_${i}">
                            ${options[i]}
                        </label>
                    </div>
                </div>
            </div>
        `;
    }
    html += `
        <div class="col-md-12 col-sm-12 gap-3 d-flex align-items-center justify-content-start">
            <button id="auto_writing_button" class="btn btn-primary" onclick="industryOptionsSeleted()">
                <i class="fa fa-check"></i> Confirm
            </button>
        </div>`;
    $('#job_post_industry_options').html(html);
    $('#job_post_industry_option_container').show(500);
}

const handleIndustryOptionChange = (element) => {
    const index = element.attributes.index.nodeValue;
    if (!element.checked) $('#industry_option_' + index).removeClass('checked');
    else $('#industry_option_' + index).addClass('checked');
    
    const industryOptionCheckedDomList = $('.job-post-option-checkbox.checked');
    industryOptions = [];
    
    for(let i = 0; i < industryOptionCheckedDomList.length; i++){
        industryOptions.push(industryOptionCheckedDomList[i].attributes.option.nodeValue.trim());    
    }
}

const industryOptionsSeleted = () => {
    const industryOptionCheckBoxDomList = $('.job-post-option-checkbox');
    
    for(let i = 0; i < industryOptionCheckBoxDomList.length; i++){
        industryOptionCheckBoxDomList[i].disabled = true
    }
    fetchChatGPTResponse(`5 possible role keypoints option keywords related to ${jobTitle}`)
        .then(response => { 
            console.log(response);
            const options = response.trim().split('\n');
            let detailOptions = [];
            for(let i = 0; i < options.length; i++){
                const option = options[i].split(':');
                if(option[0].substr(1, option[0].length -1) === "") continue;
                detailOptions.push(option[0].substr(1, option[0].length -1));
            }
            renderDetailOptions(detailOptions);   
    });
}

const renderDetailOptions = (options) => {
    let html = '';
    for(let i = 0; i < options.length; i++){
        html += `
            <div class="job-post-option">
                <div>
                    <div class="form-check d-flex align-items-center gap-1">
                        <input class="form-check-input mb-1 job-post-option-checkbox" type="radio" option="${options[i]}" onchange="handleDetailOptionChange(this)">
                        <label class="form-check-label" for="job_post_option_${i}">
                        ${options[i]}
                        </label>
                    </div>
                </div>
            </div>
        `;
    }
    $('#job_post_detail_options').html(html);
    $('#job_post_detail_option_container').show(500);
}

const handleDetailOptionChange = (element) => {
    detailOption = element.attributes.option.nodeValue.trim();
    const detailOptionCheckBoxDomList = $('.job-post-option-checkbox');
    fetchChatGPTResponse(`write job description job title is ${jobTitle} industry option is ${industryOption}, also key requirement is ${detailOption}. description shouldn't contain 'join our team' words and must contain more than 200 words`)
    .then(response => { 
        $('#job_post_detail').val(response.trim());
        $('#job_detail_container').show();
        $('#job_post_working_type_container').show(500);
    });  
    for(let i = 0; i < detailOptionCheckBoxDomList.length; i++){
        detailOptionCheckBoxDomList[i].disabled = true;  
    }
}

const setWorkingType = (type) => {
    workingType = type;
    $('#job_post_budget_container').show(500);
    let html = '';
    if(workingType === 'hourly'){
        html = `
            <option value="1">2 ~ 8$</option>
            <option value="2">8 ~ 15$</option>
            <option value="3">15 ~ 25$</option>
            <option value="4">25 ~ 50$</option>
            <option value="5">50+ $</option>
            <option value="custom">Cutomize Budget</option>`;
    }else{
        html = `
            <option value="1">10 ~ 30$</option>
            <option value="2">30 ~ 250$</option>
            <option value="3">250 ~ 750$</option>
            <option value="4">750 ~ 1500$</option>
            <option value="5">1500 ~ 3000$</option>
            <option value="6">3000+ $</option>
            <option value="custom">Cutomize Budget</option>`;
    }
    $('#job_post_budget').html(html);
    
}

const budgetSelected = (element) => {
    const value = element.value;
    if(value === 'custom'){
        $('#job_post_minimum_budget').show(500);
        $('#job_post_maximum_budget').show(500);
        $('#job_post_budget')[0].disabled = true;
    }
    else if(workingType === 'hourly'){
        switch(value){
            case '1':
                minimumBudget = 2;
                maximumBudget = 8;
                break;
            case '2':
                minimumBudget = 8;
                maximumBudget = 15;
                break;
            case '3':
                minimumBudget = 15;
                maximumBudget = 25;
                break;
            case '4':
                minimumBudget = 25;
                maximumBudget = 50;
                break;
            case '5':
                minimumBudget = 50;
                maximumBudget = 'unlimited';
                break;
            default:
                break;
        }
    }
    else if(workingType === 'fixed'){
        switch(value){
            case '1':
                minimumBudget = 10;
                maximumBudget = 30;
                break;
            case '2':
                minimumBudget = 30;
                maximumBudget = 250;
                break;
            case '3':
                minimumBudget = 250;
                maximumBudget = 750;
                break;
            case '4':
                minimumBudget = 750;
                maximumBudget = 1500;
                break;
            case '5':
                minimumBudget = 1500;
                maximumBudget = 3000;
                break;
            case '6':
                minimumBudget = 3000;
                maximumBudget = 'unlimited';
                break;
            default:
                break;
        }
    }
}

const minimumBudgetSelected = (element) => {
    minimumBudget = element.value;
}

const maximumBudgetSelected = (element) => {
    maximumBudget = element.value;
}

const writeManually = () => {
    const isValid = validJobTitle();
    if(isValid){
        $('#job_detail_container').show(500);
    }
}
    
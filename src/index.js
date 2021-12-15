/* globals ethereum */
(function () {
    const section = document.getElementById('metamask');

    if ('undefined' === typeof ethereum || !ethereum.isMetaMask) {
        section.innerHTML = `<p>${metamaskObject.textNotInstalled}</p>`;
        return;
    }

    const {
        icon,
        textLogin: alt
    } = metamaskObject;

    section.innerHTML = `<a id="metamask-login" href="javascript: void(0)" title="${alt}"><img src="${icon}" alt="${alt}"></a>`;

    document.getElementById('metamask-login').addEventListener('click', async () => {
        const accounts = await ethereum.request({method: 'eth_requestAccounts'});
        const account = accounts[0];

        console.log(account);
    });
})();

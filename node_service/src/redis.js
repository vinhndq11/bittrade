const _0x29c7=['\x20\x63\x6f\x6e\x6e\x65\x63\x74\x65\x64','\x52\x45\x44\x49\x53\x5f\x50\x41\x53\x53','\x65\x72\x72\x6f\x72','\x34\x4b\x66\x54\x63\x48\x74','\x61\x75\x74\x68','\x63\x6c\x69\x65\x6e\x74','\x6e\x75\x6c\x6c','\x52\x45\x44\x49\x53\x5f\x50\x4f\x52\x54','\x33\x31\x55\x64\x59\x68\x76\x71','\x61\x6c\x6c','\x61\x73\x73\x69\x67\x6e','\x31\x59\x4f\x6f\x7a\x45\x77','\x69\x6e\x69\x74','\x52\x45\x44\x49\x53\x5f\x44\x42','\x33\x36\x32\x34\x38\x30\x71\x67\x71\x50\x79\x46','\x65\x6e\x76','\x33\x30\x39\x39\x31\x58\x41\x54\x6f\x53\x79','\x67\x65\x74','\x36\x33\x37\x39','\x35\x33\x38\x37\x36\x62\x58\x66\x70\x78\x7a','\x72\x65\x64\x69\x73','\x35\x35\x34\x39\x35\x64\x78\x61\x72\x61\x4f','\x31\x32\x37\x2e\x30\x2e\x30\x2e\x31','\x32\x34\x31\x31\x39\x6b\x46\x68\x67\x6e\x65','\x52\x45\x44\x49\x53\x5f\x48\x4f\x53\x54','\x63\x6f\x6e\x6e\x65\x63\x74','\x32\x75\x6e\x7a\x7a\x63\x74','\x43\x6c\x69\x65\x6e\x74\x20\x77\x61\x73','\x33\x35\x39\x30\x36\x45\x69\x75\x62\x56\x50','\x68\x6f\x73\x74\x6e\x61\x6d\x65','\x57\x4f\x52\x44','\x67\x65\x74\x4d\x75\x6c\x74\x69','\x65\x78\x70\x6f\x72\x74\x73','\x63\x72\x65\x61\x74\x65\x43\x6c\x69\x65','\x6d\x65\x73\x73\x61\x67\x65','\x31\x32\x4c\x51\x51\x77\x57\x52','\x31\x35\x30\x34\x35\x34\x5a\x49\x69\x78\x69\x49','\x67\x65\x74\x49\x6e\x73\x74\x61\x6e\x63','\x6d\x61\x70'];const _0x5d98=function(_0x52f537,_0x2deaf2){_0x52f537=_0x52f537-0x6f;let _0x29c78a=_0x29c7[_0x52f537];return _0x29c78a;};const _0x4f8cfd=_0x5d98;(function(_0x444277,_0x266ee8){const _0x3e3126=_0x5d98;while(!![]){try{const _0x22a30d=parseInt(_0x3e3126(0x8d))*parseInt(_0x3e3126(0x7f))+parseInt(_0x3e3126(0x78))+-parseInt(_0x3e3126(0x72))*parseInt(_0x3e3126(0x81))+parseInt(_0x3e3126(0x8e))*parseInt(_0x3e3126(0x75))+parseInt(_0x3e3126(0x7a))*-parseInt(_0x3e3126(0x94))+parseInt(_0x3e3126(0x86))+parseInt(_0x3e3126(0x84))*parseInt(_0x3e3126(0x7d));if(_0x22a30d===_0x266ee8)break;else _0x444277['push'](_0x444277['shift']());}catch(_0x2058a5){_0x444277['push'](_0x444277['shift']());}}}(_0x29c7,0x6e13f));const redis=require(_0x4f8cfd(0x7e)),hostname=process[_0x4f8cfd(0x79)][_0x4f8cfd(0x82)]||_0x4f8cfd(0x80),port=process[_0x4f8cfd(0x79)][_0x4f8cfd(0x71)]||_0x4f8cfd(0x7c),password=process[_0x4f8cfd(0x79)][_0x4f8cfd(0x92)+_0x4f8cfd(0x88)]||null,db=process[_0x4f8cfd(0x79)][_0x4f8cfd(0x77)]||null;let instance=null;class Redis{constructor(){this['\x63\x6c\x69\x65\x6e\x74']=null;}static[_0x4f8cfd(0x8f)+'\x65'](){return instance||(instance=new Redis());}[_0x4f8cfd(0x76)](){const _0x5c5e6e=_0x4f8cfd,_0x1539c2={};_0x1539c2['\x70\x6f\x72\x74']=port,_0x1539c2[_0x5c5e6e(0x87)]=hostname,_0x1539c2['\x64\x62']=db;let _0x3d3ddf=redis['\x63\x72\x65\x61\x74\x65\x43\x6c\x69\x65'+'\x6e\x74'](_0x1539c2);const _0x2713f4={};return _0x2713f4['\x70\x6f\x72\x74']=port,_0x2713f4[_0x5c5e6e(0x87)]=hostname,_0x2713f4['\x64\x62']=db,this[_0x5c5e6e(0x6f)]=redis[_0x5c5e6e(0x8b)+'\x6e\x74'](_0x2713f4),password&&password!==_0x5c5e6e(0x70)&&(_0x3d3ddf[_0x5c5e6e(0x95)](password),this['\x63\x6c\x69\x65\x6e\x74'][_0x5c5e6e(0x95)](password)),_0x3d3ddf['\x6f\x6e'](_0x5c5e6e(0x83),()=>{const _0x33da48=_0x5c5e6e;console['\x6c\x6f\x67'](_0x33da48(0x85)+_0x33da48(0x91));}),_0x3d3ddf['\x6f\x6e'](_0x5c5e6e(0x93),function(_0x5b670b){const _0x144d2e=_0x5c5e6e;console['\x65\x72\x72\x6f\x72']('\x45\x72\x72\x6f\x72\x20\x72\x65\x64\x69'+'\x73',_0x5b670b[_0x144d2e(0x8c)]);}),_0x3d3ddf;}async[_0x4f8cfd(0x7b)](_0x54f4a2){return new Promise(_0x4ef6bb=>{const _0x4d545d=_0x5d98;this[_0x4d545d(0x6f)][_0x4d545d(0x7b)](_0x54f4a2,(_0x5c1b62,_0x1c179b)=>{if(_0x5c1b62)return _0x4ef6bb(![]);return _0x4ef6bb(_0x1c179b);});});}async[_0x4f8cfd(0x89)](_0x1c49ed=[]){const _0x330d36=_0x4f8cfd;return Promise[_0x330d36(0x73)](_0x1c49ed[_0x330d36(0x90)](_0x4d1959=>this[_0x330d36(0x7b)](_0x4d1959)['\x74\x68\x65\x6e'](_0x2e3c6d=>({[_0x4d1959]:_0x2e3c6d}))))['\x74\x68\x65\x6e'](_0x20f2f7=>Object[_0x330d36(0x74)]({},..._0x20f2f7));}}module[_0x4f8cfd(0x8a)]=Redis[_0x4f8cfd(0x8f)+'\x65']();
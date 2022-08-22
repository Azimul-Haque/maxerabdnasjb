set INTERVAL=3
:loop

git add --all
git commit -a -m "Commit %date% %time% %random%"
git push

timeout %INTERVAL%
goto:loop

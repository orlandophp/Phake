watch('(Phake/.*\.php)$') do |matches|
    test = ( matches[1].match(/Test\.php$/) ?
        matches[1] : matches[1].gsub(/\.php$/, 'Test.php')
    )

    system "clear && phpunit --bootstrap tests/bootstrap.php tests/#{test}"
end

